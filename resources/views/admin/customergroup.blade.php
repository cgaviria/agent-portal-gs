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
               
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Left column-->
                <div class="col-sm-12">
                    @foreach($group as $each_group)
                    <form class="card" name="user.profileForm">
                       
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="group-details-td"><em class="ion-document-text icon-fw mr"></em>Tour</td>
                                        <td>{{$each_group->product_code}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Port</td>
                                        <td>{{$each_group->port}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Tour Date</td>
                                        <td>{{$each_group->tour_date}}</td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Tour Time</td>
                                        <td>Continuous from {{$each_group->tour_time}} to
                                            <?php $time =  date("H:i", strtotime($each_group->tour_time));
                                                  $time = date('H:i a', strtotime($time.'+'.$each_group->tour_duration));
                                                  echo $time;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>My Guests</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Group Guests </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Meeting instructions</td>
                                        <td>{{$each_group->order_notes}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @endforeach
                        
                  
                </div>
            </div>
        </div>
    </section>
@endsection