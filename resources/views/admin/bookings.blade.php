@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div id="modal-order-date-filter" class="display-none">
            {{ csrf_field() }}
            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Start Date</label>
                        <div class="col-sm-10">
                            <input class="form-control input-order-date-start" name="input-order-date-start" type="text"><span class="help-block">YYYY/MM/DD. The start date to filter bookings from.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="date-range-end">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">End Date</label>
                        <div class="col-sm-10">
                            <input class="form-control input-order-date-end" name="input-order-date-end" type="text"><span class="help-block">YYYY/MM/DD. The end date to filter bookings up to.</span>
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
        </div>
        <div id="modal-tour-date-filter" class="display-none">
            {{ csrf_field() }}
            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">Start Date</label>
                        <div class="col-sm-10">
                            <input class="form-control input-tour-date-start" name="input-tour-date-start" type="text"><span class="help-block">YYYY/MM/DD. The start date to filter bookings from.</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="date-range-end">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align:left !important;">End Date</label>
                        <div class="col-sm-10">
                            <input class="form-control input-tour-date-end" name="input-tour-date-end" type="text"><span class="help-block">YYYY/MM/DD. The end date to filter bookings up to.</span>
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
                        <button class="btn btn-primary ripple btn-cancel-request-yes-tour" type="submit">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($client_id))
        <input type="hidden" value={{$client_id}} id="client_id">
        @else
        <input type="hidden" value='' id="client_id">
        @endif

        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Bookings</h4><small>View your bookings</small>
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    <div class="btn-group">
                        <button id="btn-order-date-range-main" class="btn ripple btn-primary" type="button">Order Date: <span id="span-order-dates-filtering">All</span></button>
                        <button class="btn dropdown-toggle ripple btn-primary" type="button" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">primary</span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="btn-order-date-range-remove-filter">All</a></li>
                            <li><a href="#" id="btn-order-date-range">Date Range...</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button id="btn-tour-date-range-main" class="btn ripple btn-primary" type="button">Tour Dates: <span id="span-tour-dates-filtering">All</span></button>
                        <button class="btn dropdown-toggle ripple btn-primary" type="button" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">primary</span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" id="btn-tour-date-range-remove-filter">All</a></li>
                            <li><a href="#" id="btn-tour-date-range">Date Range...</a></li>
                        </ul>
                    </div>
                    <a href="{{action('BookingsController@exportCSV')}}" id="btn-export-csv" class="btn btn-labeled btn-primary ripple" type="button" style="padding: 6px 16px;">Export CSV</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div id="card-body" class="card display-none">
              <div class="card-heading">&nbsp;</div>
              <!-- START table-responsive-->
              <div class="table-responsive">
                <div class="col-sm-12">
                 <table id="datatable-responsive" class="table table-striped bulk_action table-bordered dt-responsive nowrap d-none" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            @foreach($fields as $field)
                              <th>{{$field['label']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                </table>
               </div>
              </div>
              <!-- END table-responsive-->
            </div>
            <div id="card-body-loader" class="loader-demo loader-primary">
                <div class="loader-inner ball-pulse"></div>
            </div>
        </div>
    </section>
@endsection
@section('extra_script')
<script src="{{asset('js/views/admin/bookings.js?'.Config::get('app.cache_buster'))}}"></script>
<script>
  var ViewsAdminBookingsInstance = new ViewsAdminBookings();
</script>
<script type="text/javascript">
  
  function showAddForm(){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getAddForm')}}","@lang('strings.add_importer')");
  }

  function showEditForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getEditForm','')}}/"+id,"@lang('strings.edit_importer')");
  }

  function showDeleteForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getDeleteForm','')}}/"+id,"@lang('strings.delete_importer')");
  }

  function showRunForm(id){
    viewsAdminInstance.showDialog("{{URL::action('ContactImporterController@getRunForm','')}}/"+id,"@lang('strings.run_importer')");
  }

  var table;
  $(document).ready(function() {    
      //$('#admintable').hide();

      jQuery(document).data("ViewsAdminBookings").datatable = $("#datatable-responsive").DataTable({
          processing: true,
          serverSide: true,
          pageLength: 100,
          fixedHeader: {
              header: true
          },
          ajax:{
              url: '{{ url($url) }}',
              data: function (d) {
                  d.order_date_start = jQuery(document).data("ViewsAdminBookings").order_date_start;
                  d.order_date_end = jQuery(document).data("ViewsAdminBookings").order_date_end;
                  d.tour_date_start = jQuery(document).data("ViewsAdminBookings").tour_date_start;
                  d.tour_date_end = jQuery(document).data("ViewsAdminBookings").tour_date_end;
                  d.tour_date_end = jQuery(document).data("ViewsAdminBookings").tour_date_end;
                  d.client_id = jQuery(document).data("ViewsAdminBookings").client_id;
              }
          }
          ,
          columns: [
                  @foreach($fields as $field)
              {data: '{{$field['id']}}', name: '{{$field['id']}}', orderable: {{$field['ordenable'] ? 'true' : 'false' }}, searchable: {{$field['searchable'] ? 'true' : 'false' }} {!!isset($field['width']) ? ',width : "' . $field['width'] .'"' : ''!!}   },
              @endforeach
          ],
          @if(isset($checkboxes))
          'columnDefs': [
              {
                  'targets': 0,
                  'searchable':false,
                  'orderable':false,
                  "checkboxes": {
                      "selectRow": true
                  },
                  'render': function (data, type, full, meta){
                      return '<input type="checkbox" class="dt-checkboxes" name="data_id[]" value="' + $('<div/>').text(data).html() + '">';
                  }
              }
          ],
          @endif
          'select': {
              'style': 'multi'
          },
          @if(isset($order))
          "order": [
              [{{$order['order']}}, "{{$order['way']}}"]
          ],
          @else
          'order': [[1, 'asc']],
          @endif
                  @if(isset($searching))
          "bFilter": {{$searching ? 'true' : 'false'}},
          @endif
          fnInitComplete: function () {
              $('#card-body-loader').hide();
              $('#card-body').fadeIn(1000);
          }
      });
  });

  function refreshTable(){
    table = $('#datatable-responsive').DataTable().ajax.reload();
  }

</script>    
@endsection