@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Clients</h4>
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    
                   
                    <div class="btn-group">
                       <button  onclick="importClient();" class="btn ripple btn-primary" type="button">Import Clients by CSV</button>
                    </div>
                    <div class="btn-group">
                        <button onclick="showAddForm();" class="btn btn-labeled btn-primary ripple" type="button"><span class="btn-label"><i class="ion-plus-round"></i></span>Add New Client</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
                   
                   
        <div class="container-fluid">

            <div id="card-body" class="card display-none">
              <div class="card-heading">&nbsp;</div>
              <!-- START table-responsive-->
              <div class="table-responsive">
                <div class="col-sm-12">
                 <table id="datatable-responsive" class="table table-striped bulk_action table-bordered dt-responsive nowrap d-none" cellspacing="0" width="100%">
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
            <div id="card-body-loader" class="loader-demo loader-primary">
                <div class="loader-inner ball-pulse"></div>
            </div>
        </div>
    </section>

  
@endsection
@section('extra_script')
<script src="{{asset('js/views/admin/client.js?'.Config::get('app.cache_buster'))}}"></script>
<script>
  var ViewsAdminClientsInstance = new ViewsAdminClients('{!! json_encode($fields) !!}','{{ url($url) }}','{!! json_encode($order) !!}');
</script>
<script type="text/javascript">
  
  function showAddForm(){
    viewsAdminInstance.showDialog("{{URL::action('ClientsController@getAddForm')}}","@lang('strings_client.add_client')");
  }
  function importClient(){
     viewsAdminInstance.showDialog("{{URL::action('ClientsController@getImportCLient')}}","@lang('strings_client.import_client')");
  }
  function showEditForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getEditForm','')}}/"+id,"@lang('strings.edit_importer')");
  }

  function showDeleteForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ClientsController@getDeleteForm','')}}/"+id,"@lang('strings_client.delete_client')");
  }

  function showRunForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getRunForm','')}}/"+id,"@lang('strings.run_importer')");
  }
</script>    
@endsection