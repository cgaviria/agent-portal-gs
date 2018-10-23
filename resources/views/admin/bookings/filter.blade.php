{{ csrf_field() }}
            <div class="modal-body">
              
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Start Date</label>
                        <div class="col-sm-10">
                            <div class="rel-wrapper ui-datepicker ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-11">
                                <div class="mda-form-control">
                                    <input class="form-control input-order-date-start" id="example-datepicker-11" type="text" placeholder="Select a date.." name="input-order-date-start" >
                                    <div class="mda-form-control-line"></div>
                                </div>
                            </div>
                            <span class="help-block"> The start date to filter bookings from.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="date-range-end">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">End Date</label>
                        <div class="col-sm-10">
                            <div class="rel-wrapper ui-datepicker ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-10">
                                <div class="mda-form-control">
                                    <input class="form-control input-order-date-end" id="example-datepicker-10" type="text" placeholder="Select a date.."  name="input-order-date-end" >
                                    <div class="mda-form-control-line"></div>
                                </div>
                            </div>
                           <span class="help-block"> The end date to filter bookings up to.</span>
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
                        <button class="btn btn-primary ripple btn-cancel-request-yes" type="submit">Apply</button>
                    </div>
                </div>
            </div>
        

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