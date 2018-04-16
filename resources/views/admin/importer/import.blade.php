<form class="form-horizontal" method="get" action="/">
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
      <fieldset>
        <div class="form-group pull-right">
          <div class="col-sm-4">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          </div>
          <div class="col-sm-8">
            <button class="btn btn-raised btn-success ripple" type="button">Run Importer</button>
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