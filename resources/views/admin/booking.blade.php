@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div id="modal-request-cancel" class="display-none">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-12"  style="text-align:left !important; font-weight: normal !important;">Are you sure you want to request a cancellation for this booking?</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group pull-right">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary ripple btn-cancel-request-yes" type="submit">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Booking Details</h4>
                    <small>View details for a specific booking</small>
                </div>
                <div class="col-sm-4 text-right hidden-xs upper-right-buttons">
                    <button id="btn-cancel-booking" class="btn btn-labeled btn-primary ripple" type="button" style="padding: 6px 16px;">Cancel Booking</button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Left column-->
                <div class="col-md-7 col-lg-8">
                    <form class="card" name="user.profileForm">
                        <h5 class="card-heading pb0">
                            Details
                        </h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>ID</td>
                                    <td>{{$booking->id}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Order ID</td>
                                    <td>{{($booking->order_id ? $booking->order_id : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Order Date</td>
                                    <td>{{date('n/j/Y', strtotime($booking->order_date))}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Ship</td>
                                    <td>{{($booking->ship ? $booking->ship->name : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Cruise State Date</td>
                                    <td>{{($booking->cruise_start_date ? date('n/j/Y', strtotime($booking->cruise_start_date)) : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Product Name</td>
                                    <td>{{($booking->product_name ? $booking->product_name : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Tour Date</td>
                                    <td>{{($booking->tour_date ? date('n/j/Y', strtotime($booking->tour_date)) : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Tour Time</td>
                                    <td>{{($booking->tour_time ? $booking->tour_time : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Quantity Adult</td>
                                    <td>{{($booking->qty_adult ? $booking->qty_adult : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Quantity Children</td>
                                    <td>{{($booking->qty_children ? $booking->qty_children : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Payment Amount</td>
                                    <td>{{($booking->payment_amount ? '$' . number_format($booking->payment_amount, 2, '.', '') : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Affiliate Payment</td>
                                    <td>{{($booking->affiliate_payment ? '$' . number_format($booking->affiliate_payment, 2, '.', '') : 'N/A')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <!-- Right column-->
                <div class="col-md-5 col-lg-4">
                    <div class="card">
                        <h5 class="card-heading">
                            Customer
                        </h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>ID</td>
                                    <td>{{($booking->customer_id ? $booking->customer_id : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Full Name</td>
                                    <td>{{($booking->getFullName() ? $booking->getFullName() : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Phone</td>
                                    <td>{{($booking->customer_phone_number ? $booking->customer_phone_number : 'N/A')}}</td>
                                </tr>
                                <tr>
                                    <td><em class="ion-document-text icon-fw mr"></em>Email</td>
                                    <td>{{($booking->customer_email_address ? $booking->customer_email_address : 'N/A')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($booking->group)
                        <div class="card">
                            <h5 class="card-heading">
                                Group
                            </h5>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>ID</td>
                                        <td>{{$booking->group->id}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Group Name</td>
                                        <td>{{$booking->group->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>URL</td>
                                        <td><a href="{{action('GroupsController@getGroup', array($booking->group->id))}}">Click Here</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('js/views/admin/booking.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsAdminBookingInstance = new ViewsAdminBooking('{{action('BookingsController@cancelBooking', array($booking->id))}}');
    </script>
@endsection