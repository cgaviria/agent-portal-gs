<form class="form-horizontal" method="post"  id="form_delete_importer" action="{{URL::action('AdminController@delete')}}" onsubmit="viewsGlobalInstance.sendForm(this,ViewsAdminMyAccountInstance.responseForm);return  false;">
  {{ csrf_field() }}
  <input type="hidden" name="ci_id" value="{{$ci->id}}">
  <div class="modal-body">
      <div class="form-group">
        <label class="col-sm-12"  style="text-align:left !important; font-weight: normal !important;">Are you sure you want to delete this image?</label>
      </div>
  </div>
   <div class="modal-footer">
      <div class="form-group pull-right">
        <div class="col-sm-6">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-danger ripple" type="submit">Delete</button>
        </div>
      </div>
  </div>
</form>

<script type="text/javascript">

</script>