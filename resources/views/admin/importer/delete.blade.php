<form class="form-horizontal" method="post"  id="form_delete_importer" action="{{URL::action('ContactImporterController@delete')}}" onsubmit="viewsGlobalInstance.sendForm(this,viewsAdminImporterInstance.responseForm);return  false;">
  {{ csrf_field() }}
  <input type="hidden" name="ci_id" value="{{$ci->id}}">
  <div class="modal-body">
    <fieldset>
        <div class="form-group">
          <label class="col-sm-12 control-label"  style="text-align:left !important;">Are you sure you want to delete this contact import source?</label>
        </div>
    </fieldset>
  </div>
   <div class="modal-footer">
      <div class="form-group pull-right">
        <div class="col-sm-6">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-raised btn-danger ripple" type="submit">Delete</button>
        </div>
      </div>
  </div>
</form>

<script type="text/javascript">

</script>