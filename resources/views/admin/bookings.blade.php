@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
     
        @if(isset($client_id))
        <input type="hidden" value={{$client_id}} id="client_id">
        @else
        <input type="hidden" value='' id="client_id">
        @endif
         @if(isset($group_id))
        <input type="hidden" value={{$group_id}} id="group_id">
        @else
        <input type="hidden" value='' id="group_id">
        @endif
        <input type="hidden" value="{{url('forms/booking/filter')}}" id="booking_filter">
        <input type="hidden" value="{{url('forms/booking/tour_filter')}}" id="tour_filter">
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                  @if($title)
                      <h4 class="m0 text-thin">{{$title}}</h4><small>View your bookings</small>
                  @else
                      <h4 class="m0 text-thin">Bookings</h4><small>View your bookings</small>
                  @endif
                    
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                  
                        <a href="#" id="btn-all-remove-filter" class="btn btn-danger ripple" type="button" style="padding: 6px 16px; display: none;">Clear Filters</a>
                           
                    
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
                  d.group_id = jQuery(document).data("ViewsAdminBookings").group_id;
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
