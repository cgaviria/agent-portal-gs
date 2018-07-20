@extends('layouts.admin')
@section('content')
    <script src="{{asset('js/views/admin/agency.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsAdminAgencyInstance = new ViewsAdminAgency({!! json_encode($datatables_params) !!});
    </script>
    <section>

         @include('admin.agency.add')
       
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Agency</h4>
                    <small>View  all the agencies</small>
                </div>
                
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    <a href="#" id="btn-create-user" class="btn btn-labeled btn-primary ripple" type="button" style="padding: 6px 16px;">Create Agency</a>
                </div>
                
            </div>
        </div>
        <div class="container-fluid">
            <div id="card-body" class="card display-none">
              <div class="card-heading">&nbsp;</div>
              <!-- START table-responsive-->
              <div class="table-responsive">
                <div class="col-sm-12">
                 <table id="datatable-responsive" class="table table-striped bulk_action table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            @foreach($datatables_params['fields'] as $field)
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