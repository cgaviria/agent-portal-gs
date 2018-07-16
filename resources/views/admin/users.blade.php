@extends('layouts.admin')
@section('content')
    <script src="{{asset('js/views/admin/users.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsAdminUsersInstance = new ViewsAdminUsers({!! json_encode($datatables_params) !!});
    </script>
    <section>
        <div id="modal-create-user" class="display-none">
            {{ csrf_field() }}
            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">First Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="first-name" name="first-name" type="text"><span class="help-block">The first name of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Last Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="last-name" name="last-name" type="text"><span class="help-block">The last name of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="email" name="email" type="text"><span class="help-block">The email of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="password" name="password" type="text"><span class="help-block">The password of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Confirm Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="text"><span class="help-block">Confirm the password entered above.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role">
                                <option value="agent">Agent</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Agency</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agency_id">
                                <option value="1">Test Agency One</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <div class="form-group pull-right">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary ripple btn-cancel-request-yes" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </div>
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