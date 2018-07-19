<div id="modal-create-user" class="display-none">
   <form class="form-horizontal"  id="form_add_user" method="post" action="{{URL::action('UsersController@save')}}" onsubmit="viewsGlobalInstance.sendForm(this,ViewsAdminUsersInstance.responseForm);return  false;">
            {{ csrf_field() }}

            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">First Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="first-name" name="first_name" type="text"><span class="help-block">The first name of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Last Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="last-name" name="last_name" type="text"><span class="help-block">The last name of the new user.</span>
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
                            <input class="form-control" id="password" name="password" type="password"><span class="help-block">The password of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Confirm Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"><span class="help-block">Confirm the password entered above.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="role" onchange = "show_agency(this)">
                              <option value="">Select</option>
                              @foreach($datatables_params['roles'] as $role)
                                <option value="{{$role->slug}}">{{$role->name}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                 <fieldset class="agencyname" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Agency Name</label>
                        <div class="col-sm-10">
                           <input class="form-control" id="agency_name" name="agency_name" type="text"><span class="help-block">The agency name of the agency manager.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="agentselect" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Agency</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agency_id">
                                  <option value="">Select agency</option>
                                @foreach($datatables_params['agencies'] as $agency)
                                  <option value="{{$agency->id}}">{{$agency->name}}</option>
                                @endforeach
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
         </form>
      </div>
      <script>
        function show_agency(a){
          if(a.value == "agency"){
            $('.agentselect').css('display','none');
            $('.agencyname').css('display','block');
          }
          else if(a.value == "agent"){
            $('.agencyname').css('display','none');
            $('.agentselect').css('display','block');
          }
          else{
            $('.agencyname').css('display','none');
            $('.agentselect').css('display','none');
          }
        }
      </script>