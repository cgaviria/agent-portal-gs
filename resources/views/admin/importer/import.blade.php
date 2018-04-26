<form class="form-horizontal" method="get" action="/">
  <div class="modal-body">
      @if($ci->save_pawd == 'y')
        <div class="form-group">
          <label class="col-sm-12 control-label" style="text-align:left !important; font-weight: normal !important;">Are you sure you want to manually import your contacts?</label>
        </div>
      @else
      <fieldset>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input class="form-control" type="password"><span class="help-block">The password of your email account</span>
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
      @endif
  </div>
   <div class="modal-footer">
        <div class="form-group pull-right">
          <div class="col-sm-4">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          </div>
          <div class="col-sm-8">
            <button class="btn btn-raised btn-primary ripple" type="button">Run Importer</button>
          </div>
        </div>
  </div>
</form>

<script type="text/javascript">

</script>