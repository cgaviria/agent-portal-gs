<div id="modal-create-user" class="display-none">
   <form class="form-horizontal form_add_user" id="form_add_user" method="post" action="{{URL::action('UsersController@save')}}">
            {{ csrf_field() }}

            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">First Name</label>
                        <div class="col-sm-10">
                            <input class="form-control first_name" id="first_name" name="first_name" type="text"><span class="help-block">The first name of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Last Name</label>
                        <div class="col-sm-10">
                            <input class="form-control last_name" id="last_name" name="last_name" type="text"><span class="help-block">The last name of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control email" id="email" name="email" type="text"><span class="help-block">The email of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control password" id="password" name="password" type="password"><span class="help-block">The password of the new user.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Confirm Password</label>
                        <div class="col-sm-10">
                            <input class="form-control password_confirmation" id="password_confirmation" name="password_confirmation" type="password"><span class="help-block">Confirm the password entered above.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control role" name="role" id="role" onchange = "show_agency(this)">
                              <option value="">Select</option>
                              @foreach($datatables_params['roles'] as $role)
                                <option value="{{$role->slug}}">{{$role->name}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="agentselect" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Agency</label>
                        <div class="col-sm-10">
                            <select class="form-control agency_id" name="agency_id">
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
          if(a.value == "agency" || a.value == "agent"){
            $('.agentselect').css('display','block');
          }
          else{
            $('.agentselect').css('display','none');
          }
        }
      </script>