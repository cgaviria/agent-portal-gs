@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Group Details</h4>
                    <small>View details for a specific group</small>
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
                                        <td class="group-details-td"><em class="ion-document-text icon-fw mr"></em>ID</td>
                                        <td>{{$group->id}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Name</td>
                                        <td>{{$group->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>URL</td>
                                        <td>{{$group->url}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Email</td>
                                        <td>{{$group->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Sail Date</td>
                                        <td>{{($group->sail_date ? date('n/j/Y', strtotime($group->sail_date)) : 'N/A')}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Ship</td>
                                        <td>{{($group->ship ? $group->ship->name : 'N/A')}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Duration</td>
                                        <td>{{($group->duration ? $group->duration . ' days' : 'N/A')}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Text</td>
                                        <td>{{($group->text ? htmlspecialchars($group->text) : 'N/A')}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Image</td>
                                        <td>{!! ($group->image ? '<img src="' . $group->image . '" />' : 'N/A') !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @if ($group->getBookings()->count())
                        <form class="card" name="user.profileForm">
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
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection