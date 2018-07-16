
  <form class="form-horizontal"  id="form_add_importer" method="post" action="{{URL::action('ClientsController@import')}}" onsubmit="ViewsAdminClientsInstance.sendForm(this,ViewsAdminClientsInstance.responseForm);return  false;" enctype="multipart/form-data">
     {{ csrf_field() }}
     <input type="hidden" name="user_id" value="{{$user_login->id}}">
  <div class="modal-body">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">CSV to upload</label>
            <div class="col-sm-10">
              <input class="form-control" id="csv_file" name="csv_file" type="file"><span class="help-block">CSV file to import</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Ship</label>
            <div class="col-sm-10">
              <select class="form-control" name="ship">
                @foreach ($ships as $each_ship)
                     <option value="{{ $each_ship->id }}">{{ $each_ship->name }}</option>
                @endforeach
              </select>
              <span class="help-block">Select the ship this client will be embarking on.</span>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Sail Date</label>
            <div class="col-sm-10">
              <div class="rel-wrapper ui-datepicker ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-9">
                  <div class="mda-form-control">
                    <input class="form-control" id="example-datepicker-9" type="text" placeholder="Select a date.." name="sail_date" >
                    <div class="mda-form-control-line"></div>
                    
                  </div>
                </div>
                <span class="help-block">Select a sail date for the cruise.</span>
            </div>

          </div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left !important;">Duration</label>
            <div class="col-sm-10">
              <input class="form-control" name="duration" type="text">
              <span class="help-block">The duration of the cruise.</span>
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
