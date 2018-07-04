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
                <div class="col-xs-6 col-lg-3">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">50</h4><small class="m0 text-muted"><em class="mr-sm ion-arrow-up-b"></em>Bookings</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <div class="sparkline" id="sparkline2" data-line-color="#4caf50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">3</h4><small class="m0 text-muted"><em class="mr-sm ion-arrow-down-b"></em>Groups</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <div class="sparkline" id="sparkline1" data-line-color="#03A9F4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-3 visible-lg">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">300</h4><small class="m0 text-muted"><em class="mr-sm ion-arrow-up-b"></em>Clients</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <div class="sparkline" id="sparkline3" data-line-color="#ab47bc"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-3 visible-lg">
                    <div class="card">
                        <div class="card-body pv">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="m0 text-thin">100</h4><small class="m0 text-muted"><em class="mr-sm ion-arrow-up-b"></em>Imported Contacts</small>
                                </div>
                                <div class="pull-right mt-lg">
                                    <div class="sparkline" id="sparkline4" data-line-color="#e91e63"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row" style="margin-left:0px;margin-right:0px">
                        <!-- Activity feed-->
                        <div class="card">
                            <div class="card-heading">
                                <!-- START dropdown-->
                                <div class="pull-right dropdown">
                                    <button class="btn btn-default btn-flat btn-flat-icon" type="button" data-toggle="dropdown"><em class="ion-android-more-vertical"></em></button>
                                    <ul class="dropdown-menu md-dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="">Last 30 days</a></li>
                                        <li><a href="">Last week</a></li>
                                        <li><a href="">Last year</a></li>
                                    </ul>
                                </div>
                                <!-- END dropdown-->
                                <div class="card-title">Activity</div><small>What's been going on</small>
                            </div>
                            <div class="card-body bb">
                                <p class="pull-left mr"><a href=""><img class="img-circle thumb32" src="{{asset('images/christian_gaviria_foto_square.jpeg')}}" alt="User"></a></p>
                                <div class="oh">
                                    <p><strong class="spr">Christian</strong><span class="spr">added a new Booking</span><a href="">Jane Smith - Norwegian Cruise Line - Sail Date 5/11/2018</a></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>2 hours ago</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bb">
                                <p class="pull-left mr"><a href=""><img class="img-circle thumb32" src="{{asset('images/christian_gaviria_foto_square.jpeg')}}" alt="User"></a></p>
                                <div class="oh">
                                    <p><strong class="spr">Christian</strong><span class="spr">added a new Booking</span><a href="">Jane Smith - Norwegian Cruise Line - Sail Date 5/11/2018</a></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>2 hours ago</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bb">
                                <p class="pull-left mr"><a href=""><img class="img-circle thumb32" src="{{asset('images/christian_gaviria_foto_square.jpeg')}}" alt="User"></a></p>
                                <div class="oh">
                                    <p><strong class="spr">Christian</strong><span class="spr">added a new Booking</span><a href="">Jane Smith - Norwegian Cruise Line - Sail Date 5/11/2018</a></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>2 hours ago</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bb">
                                <p class="pull-left mr"><a href=""><img class="img-circle thumb32" src="{{asset('images/christian_gaviria_foto_square.jpeg')}}" alt="User"></a></p>
                                <div class="oh">
                                    <p><strong class="spr">Christian</strong><span class="spr">added a new Booking</span><a href="">Jane Smith - Norwegian Cruise Line - Sail Date 5/11/2018</a></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>2 hours ago</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bb">
                                <p class="pull-left mr"><a href=""><img class="img-circle thumb32" src="{{asset('images/christian_gaviria_foto_square.jpeg')}}" alt="User"></a></p>
                                <div class="oh">
                                    <p><strong class="spr">Christian</strong><span class="spr">added a new Booking</span><a href="">Jane Smith - Norwegian Cruise Line - Sail Date 5/11/2018</a></p>
                                    <div class="clearfix">
                                        <div class="pull-left text-muted"><em class="ion-android-time mr-sm"></em><span>2 hours ago</span></div>
                                    </div>
                                </div>
                            </div>
                            <a class="card-footer btn btn-flat btn-default" href=""><small class="text-center text-muted lh1">See more activities</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_script')
       
@endsection