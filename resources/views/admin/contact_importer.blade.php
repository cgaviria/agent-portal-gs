@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Dashboard</h4><small>Contact Importer</small>
                </div>
                <div class="col-sm-4 text-right hidden-xs">
                    <button class="mt-sm btn btn-labeled btn-default ripple" type="button">Add New<span class="btn-label btn-label-right"><i class="ion-plus-round"></i></span></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
              <div class="card-heading">Contact Importer</div>
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
<script type="text/javascript">
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
              {data: '{{$field['id']}}', name: '{{$field['id']}}', orderable: {{$field['ordenable'] ? 'true' : 'false' }}, searchable: {{$field['searchable'] ? 'true' : 'false' }}   },
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