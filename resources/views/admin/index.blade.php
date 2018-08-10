@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-9">
                    <h4 class="m0 text-thin">Home Dashboard</h4><small>General overview of everything</small>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-lg-4">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">{{$booking}}</h4><small class="m0 text-muted">{!!$arrowBooking!!}Bookings</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <input type="hidden" id="bokkinglist" value="{{URL::action('BookingsController@getBookingMonthly')}}">
                                    <div class="sparkline" id="sparkline2" data-line-color="#4caf50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">{{$group}}</h4><small class="m0 text-muted">{!!$arrowGrouping!!}Groups</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <input type="hidden" id="grouplist" value="{{URL::action('GroupsController@getGroupMonthly')}}">
                                    <div class="sparkline" id="sparkline1" data-line-color="#03A9F4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-4 visible-lg">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">{{$client}}</h4><small class="m0 text-muted">{!!$arrowClient!!}Clients</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <input type="hidden" id="clientlist" value="{{URL::action('ClientsController@getClientMonthly')}}">
                                    <div class="sparkline" id="sparkline3" data-line-color="#ab47bc"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xs-6 col-lg-3 visible-lg">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">{{$ContactImporter}}</h4><small class="m0 text-muted"><em class="mr-sm ion-arrow-up-b"></em>Imported Contacts</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <div class="sparkline" id="sparkline4" data-line-color="#e91e63"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row" style="margin-left:0px;margin-right:0px">
                        <!-- Activity feed-->
                        <div class="card">
                            <div class="card-heading">
                                <!-- START dropdown-->
                                <div class="pull-right dropdown">
                                   <!-- <button class="btn btn-default btn-flat btn-flat-icon" type="button" data-toggle="dropdown"><em class="ion-android-more-vertical"></em></button>
                                    <ul class="dropdown-menu md-dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="">Last 30 days</a></li>
                                        <li><a href="">Last week</a></li>
                                        <li><a href="">Last year</a></li>
                                    </ul>-->
                                </div>
                                <!-- END dropdown-->
                                <div class="card-title">Activity</div><small>What's been going on</small>
                            </div>
                            @if(count($activites_user)>0)
                            @foreach($activites_user as $activity)
                            <div class="card-body bb" style="display:none;">

                                <p class="pull-left mr">
                                    <a href=""> 
                                        @if ($activity->photo)
                                            <img class="img-circle thumb40" src="{{asset(((!empty($activity->image_thumbnails[\App\User::THUMB_SIDEBAR])) ? $activity->image_thumbnails[\App\User::THUMB_SIDEBAR] : $activity->photo))}}">
                                        @else
                                            <span class="ion-person sidebar-no-picture"></span>
                                        @endif
                                    </a></p>
                                <div class="oh">
                                    <p><strong class="spr">{{$activity->first_name}}</strong><span class="spr">{!! str_replace('%a', url($activity->url) , $activity->description) !!}</span></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>
                                            <?php 
                                              $secondsDifference=strtotime(date('Y-m-d H:i:s'))-strtotime($activity->created_at);
                                              $minutes = $secondsDifference>60?intval($secondsDifference/60):"";
                                              $hour = $minutes>60?intval($minutes/60):"";
                                              $days = $hour>24?intval($hour/24):"";
                                              if($secondsDifference<60)
                                                echo $secondsDifference==1?$secondsDifference." second ago":$secondsDifference." seconds ago";
                                              if($days>0)
                                                 echo ($days==1)?$days." day ago":$days." days ago";
                                              else if($hour>0)
                                                 echo ($hour==1)?$hour." hour ago":$hour." hours ago";
                                              else if($minutes>0 )
                                                 echo ($minutes==1)?$minutes." minute ago":$minutes." minutes ago";
                                              ?>
                                             </span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            

                            <a class="card-footer btn btn-flat btn-default" id="loadMore" href="javascript:void(0)"><small class="text-center text-muted lh1">See more activities</small></a>
                            @else
                             <a class="card-footer btn btn-flat btn-default" href=""><small class="text-center text-muted lh1">There are no activities yet</small></a>
                            @endif


                         

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
@endsection

@section('extra_script')
       
@endsection