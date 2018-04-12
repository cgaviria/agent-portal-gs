<form class="form-horizontal" method="get" action="/">
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">The IMAP host of your email account</label>
          <div class="col-sm-10">
            <input class="form-control" type="text">
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">The IMAP port of your email account.</label>
          <div class="col-sm-10">
            <input class="form-control" type="text">
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">Your email account.</label>
          <div class="col-sm-10">
            <input class="form-control" type="text">
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">The password of your email account.</label>
          <div class="col-sm-10">
            <input class="form-control" type="password"><span class="help-block"><input checked onchange="hideFrecuency()" type="checkbox" id="store_password" > Store Password</span>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">Confirm Password</label>
          <div class="col-sm-10">
            <input class="form-control" type="password">
          </div>
        </div>
      </fieldset>
      <fieldset id="frequency_import">
        <div class="form-group">
          <label class="col-sm-2 control-label">Frequency of Import</label>
          <div class="col-sm-10">
            <select class="form-control" name="account">
              <option value="auto">Automatic</option>
              <option value="daily">Daily</option>
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
            </select>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <div class="form-group">
          <div class="col-sm-12">
            <span class="pull-right"><button class="btn btn-raised btn-success ripple" type="button">Save Contact Import Source</button></span>
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