@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Contact Importer</h4><small>Manage your email accounts that are used to import your contacts</small>
                </div>
                <div class="col-sm-4 text-right hidden-xs">
                    <button onclick="showAddForm();" class="btn btn-labeled btn-primary ripple" type="button"><span class="btn-label"><i class="ion-plus-round"></i></span>Add Contact Import Source</button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
              <div class="card-heading">&nbsp;</div>
              <!-- START table-responsive-->
              <div class="table-responsive">
                <div class="col-sm-12">
                 <table id="datatable-responsive" class="table table-striped bulk_action table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            @foreach($fields as $field)
                              <th>{{$field['label']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                </table>
               </div>
              </div>
              <!-- END table-responsive-->
            </div>
        </div>
    </section>
@endsection
@section('extra_script')
<script src="{{asset('js/views/admin/importer/index.js?'.Config::get('app.cache_buster'))}}"></script> 
<script>
  var viewsAdminImporterInstance = new ViewsAdminImporter();
</script>
<script type="text/javascript">
  
  function showAddForm(){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getAddForm')}}","@lang('strings.add_importer')");
  }

  function showEditForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getEditForm','')}}/"+id,"@lang('strings.edit_importer')");
  }

  function showDeleteForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getDeleteForm','')}}/"+id,"@lang('strings.delete_importer')");
  }

  function showRunForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getRunForm','')}}/"+id,"@lang('strings.run_importer')");
  }

  var table;
  $(document).ready(function() {    
      //$('#admintable').hide();
      
      table = $("#datatable-responsive").DataTable({
        processing: true,
        serverSide: true,
        pageLength: 100,
        fixedHeader: {
            header: true
        },
        ajax:{
          url: '{{ url($url) }}',
        } ,
        columns: [
            @foreach($fields as $field)
              {data: '{{$field['id']}}', name: '{{$field['id']}}', orderable: {{$field['ordenable'] ? 'true' : 'false' }}, searchable: {{$field['searchable'] ? 'true' : 'false' }} {!!isset($field['width']) ? ',width : "' . $field['width'] .'"' : ''!!}   },
            @endforeach
        ],
        @if(isset($checkboxes))
        'columnDefs': [
            {
               'targets': 0,
               'searchable':false,
               'orderable':false,
               "checkboxes": {
                    "selectRow": true
               },
               'render': function (data, type, full, meta){
                   return '<input type="checkbox" class="dt-checkboxes" name="data_id[]" value="' + $('<div/>').text(data).html() + '">';
               }
            }
         ],
        @endif
        'select': {
            'style': 'multi'
        },
        @if(isset($order))
         "order": [
              [{{$order['order']}}, "{{$order['way']}}"]
         ],
        @else
          'order': [[1, 'asc']],
        @endif
        @if(isset($searching))
         "bFilter": {{$searching ? 'true' : 'false'}},
        @endif
        fnInitComplete: function () {
            //$('#admintable').show();
        }
    });
  });

  function refreshTable(){
    table = $('#datatable-responsive').DataTable().ajax.reload();
  }

</script>    
@endsection