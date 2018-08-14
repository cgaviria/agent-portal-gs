@extends('layouts.admin')
@section('content')
    <script src="{{asset('js/views/admin/users.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
         var ViewsAdminUsersInstance = new ViewsAdminUsers({!! json_encode($datatables_params) !!});
    </script>
    <section>

         @include('admin.user.add')

        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Users</h4>
                    @if ($logged_in_user = Sentinel::getUser())
                    @endif
                    @if ($logged_in_user->inRole(\App\Role::ROLE_ADMIN))
                        <small>View users in all agencies</small>
                    @elseif ($logged_in_user->inRole(\App\Role::ROLE_OWNER))
                        <small>View users in your agencies</small>
                    @else
                        <small>View users in your agency</small>
                    @endif
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    <a href="#" id="btn-create-user" class="btn btn-labeled btn-primary ripple" type="button" style="padding: 6px 16px;">Create User</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div id="card-body" class="card display-none">
              <div class="card-heading">&nbsp;</div>
              <input type="hidden" id="deactivated_link" value="{{URL::action('UsersController@getDeleteForm','')}}/">
              <input type="hidden" id="activated_link" value="{{URL::action('UsersController@getActivateForm','')}}/">
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