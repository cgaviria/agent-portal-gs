
  <form class="form-horizontal"  id="form_add_importer" method="post" action="{{URL::action('ClientsController@import')}}" onsubmit="ViewsAdminClientsInstance.sendForm(this,ViewsAdminClientsInstance.responseForm);return  false;" enctype="multipart/form-data">
     {{ csrf_field() }}
     <input type="hidden" name="user_id" value="{{$user_login->id}}">
  <div class="modal-body">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">CSV to upload</label>
            <div class="col-sm-4">
              <input class="form-control" id="csv_file" name="csv_file" type="file"><span class="help-block">CSV file to import</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Ship</label>
            <div class="col-sm-4">
              <select class="form-control" name="ship">
                @foreach ($ships as $each_ship)
                     <option value="{{ $each_ship->id }}">{{ $each_ship->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Sail Date</label>
            <div class="col-sm-4">
              <input class="form-control" name="sail_date" type="text">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Duration</label>
            <div class="col-sm-4">
              <input class="form-control" name="duration" type="text">
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
        <input class="btn btn-primary col-sm-12" type="submit" value="Save">
      </div>
    </div>  
  </div>
  </form>

  <script type="text/javascript">
  function hideFrequency(){

      var ifischeking = $('#store_password:checkbox:checked').length > 0;
      if(ifischeking){
        $("#frequency_import").slideDown();
      }else{
        $("#frequency_import").slideUp();
      }
  }
  </script>
