
  <form class="form-horizontal"  id="form_edit_importer" method="post" action="{{URL::action('ContactImporterController@edit')}}" onsubmit="viewsGlobalInstance.sendForm(this,viewsAdminImporterInstance.responseForm);return  false;">
     {{ csrf_field() }}
     <input type="hidden" name="user_id" value="{{$user_login->id}}">
     <input type="hidden" name="ci_id" value="{{$ci->id}}">
  <div class="modal-body">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">IMAP Host</label>
            <div class="col-sm-10">
              <input class="form-control" name="imap_host" value="{{$ci->imap_host}}" type="text"><span class="help-block">The IMAP host of your email account.</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">IMAP Port</label>
            <div class="col-sm-10">
              <input class="form-control" name="imap_port" value="{{$ci->imap_port}}" type="text"><span class="help-block">The IMAP port of your email account.</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Email</label>
            <div class="col-sm-10">
              <input class="form-control" name="email" value="{{$ci->email}}" type="text"><span class="help-block">Your email account.</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">{{$ci->save_password == 'y' ? 'Change Password' : 'Password'}}</label>
            <div class="col-sm-4">
              <input class="form-control" name="password" value="{{$ci->save_password == 'y' ? $ci->password : ''}}" type="password">
            </div>
            <label class="col-sm-2 control-label" style="text-align:left !important;">Confirm Password</label>
            <div class="col-sm-4">
              <input class="form-control" name="password_confirmation" value="{{$ci->save_password == 'y' ? $ci->password : ''}}" type="password">
            </div>
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-10"><span class="help-block">Unless otherwise indicated by the Store Password setting below, we will not store your password and only use it once to fetch your contacts.</span>
              <div class="checkbox c-checkbox">
                <label>
                  <input type="checkbox" {{$ci->save_password == 'y' ? 'checked' : ''}} name="save_password" onchange="hideFrequency()" id="store_password" value="y"><span class="ion-checkmark-round"></span> Store Password
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset id="frequency_import">
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Frequency of Import</label>
            <div class="col-sm-10">
              <select class="form-control" name="refresh">
                <option {{$ci->refresh == 'daily' ? 'selected' : ''}}  value="daily">Daily</option>
                <option {{$ci->refresh == 'weekly' ? 'selected' : ''}} value="weekly" selected>Weekly</option>
                <option {{$ci->refresh == 'monthly' ? 'selected' : ''}} value="monthly">Monthly</option>
              </select>
              <span class="help-block">How often you want us to access your inbox to retrieve contacts.</span>
            </div>
          </div>
        </fieldset>
  </div>
  <div class="modal-footer">
    <div class="form-group pull-right">
      <div class="col-sm-4">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
      <div class="col-sm-8">
        <input class="btn btn-raised btn-primary ripple" type="submit" value="Save">
      </div>
    </div>  
  </div>
  </form>

  <script type="text/javascript">
      hideFrequency();
  function hideFrequency(){

      var ifischeking = $('#store_password:checkbox:checked').length > 0;
      if(ifischeking){
        $("#frequency_import").slideDown();
      }else{
        $("#frequency_import").slideUp();
      }
  }
  </script>
