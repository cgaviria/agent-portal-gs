@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Group Details</h4>
                    <small>View details for a specific group</small>
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    <a href="{{ URL::to('/dashboard/group/booking/' . $group->id) }}" id="btn-all-remove-filter" class="btn btn-primary ripple" type="button" style="padding: 6px 16px;">
                        @if($count_booking)
                            View Bookings
                        @elseif($count_booking == 0)
                            No bookings available
                        @endif
                    </a>
                 </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Left column-->
                <div class="col-sm-12">
                    <form class="card" name="user.profileForm">
                        <h5 class="card-heading pb0">
                            Details
                        </h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Group Name</td>
                                        <td>{{$group->name}}</td>
                                    </tr>
                                   <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>URL</td>
                                        <td><a href="http://www.shoreexcursionsgroup.com/group/{{$group->url}}" target="_blank">Click Here</a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Sail Date</td>
                                        <td>{{($group->sail_date ? date('n/j/Y', strtotime($group->sail_date)) : 'N/A')}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <form class="card" name="user.profileForm">
                     <div class="card-body">
                                <table class="table table-bordered">
                                    <thead><tr>
                                        <th>Agent</th>
                                        <th>Tour Port</th>
                                        <th>Tour Name</th>
                                        <th>Number Of Children</th>
                                        <th>Number Of Adults</th>
                                        <th>Total Attending</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($agents as $each_details)
                                        <tr>
                                            <td>{{$each_details->first_name}} {{$each_details->last_name}}</td>
                                            <td>{{$each_details->port}}</td>
                                            <td>{{$each_details->product_name}}</td>
                                            <td>{{$each_details->qty_children}}</td>
                                            <td>{{$each_details->qty_adult}}</td>
                                            <td>{{$each_details->total}}</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    @if ($group->getBookings()->count())
                       <!-- <form class="card" name="user.profileForm">
                            <h5 class="card-heading pb0">
                                Bookings
                            </h5>
                           
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead><tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Port</th>
                                        <th>Tour Date</th>
                                        <th>Tour Time</th>
                                        <th>URL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($group->getBookings() as $booking)
                                        <tr>
                                            <td>{{$booking->id}}</td>
                                            <td>{{($booking->product_name ? $booking->product_name : 'N/A')}}</td>
                                            <td>{{($booking->port ? $booking->port : 'N/A')}}</td>
                                            <td>{{($booking->tour_date ? date('n/j/Y', strtotime($booking->tour_date)) : 'N/A')}}</td>
                                            <td>{{($booking->tour_time ? $booking->tour_time : 'N/A')}}</td>
                                            <td><a href="{{action('BookingsController@getBooking', array($booking->id)) }}">Click Here</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>-->
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection