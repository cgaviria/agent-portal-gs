<form class="form-horizontal" method="get" action="/">
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">IMAP Host</label>
          <div class="col-sm-10">
            <input class="form-control" type="text"><span class="help-block">The IMAP host of your email account.</span>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">IMAP Port</label>
          <div class="col-sm-10">
            <input class="form-control" type="text"><span class="help-block">The IMAP port of your email account.</span>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input class="form-control" type="text"><span class="help-block">Your email account.</span>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-4">
            <input class="form-control" type="password">
            <div class="checkbox c-checkbox">
              <label>
                <input type="checkbox" checked onchange="hideFrecuency()" id="store_password" value=""><span class="ion-checkmark-round"></span> Store Password
              </label>
            </div>
          </div>
          <label class="col-sm-2 control-label">Confirm Password</label>
          <div class="col-sm-4">
            <input class="form-control" type="password">
          </div>
        </div>
      </fieldset>
      <fieldset id="frequency_import">
        <div class="form-group">
          <label class="col-sm-2 control-label">Frequency of Import</label>
          <div class="col-sm-10">
            <select class="form-control" name="account">
              <option value="daily">Daily</option>
              <option value="weekly" selected>Weekly</option>
              <option value="monthly">Monthly</option>
            </select>
            <span class="help-block">How often you want us to access your inbox to retrieve contacts.</span>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <div class="col-sm-12">
            <span class="pull-right"><button class="btn btn-raised btn-success ripple" type="button">Save</button></span>
          </div>
        </div>
      </fieldset>
</form>

<script type="text/javascript">
function hideFrecuency(){

    var ifischeking = $('#store_password:checkbox:checked').length > 0;
    if(ifischeking){
      $("#frequency_import").show();
    }else{
      $("#frequency_import").hide();
    }
}
</script>