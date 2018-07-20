<div id="modal-create-agency" class="display-none">
   <form class="form-horizontal"  id="form_add_user" method="post" action="{{URL::action('AgencyController@save')}}" onsubmit="viewsGlobalInstance.sendForm(this,ViewsAdminAgencyInstance.responseForm);return  false;">
            {{ csrf_field() }}

            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">First Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="agency-name" name="agency_name" type="text"><span class="help-block">The agency name.</span>
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
                        <button class="btn btn-primary ripple btn-cancel-request-yes" type="submit">Create</button>
                    </div>
                </div>
            </div>
         </form>
      </div>
     