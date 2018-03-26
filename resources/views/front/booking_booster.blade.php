@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/bookingbooster.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontBookingBoosterInstance = new ViewsFrontBookingBooster();
    </script>
    <div id="header">
        @include('menu.front.top')
    </div>
    <!-- #header -->
    <div id="main">
        @include('menu.front.sideleft')
        <div class="content-wrap">
            <div id="content">
                <div class="hfeed">
                    <div id="post-828" class="hentry page publish post-1 odd author-agentportaladmin">
                        <h1 class='page-title entry-title'>Booking Booster</h1>
                        <div class="entry-content">
                            <p>Sorry! We don&#8217;t recognize the affiliate link you&#8217;ve used to access the Booking Booster.</p>
                            <p>Our system only accepts booking data submitted via authorized affiliate links. Please make sure to use the link that we sent to you to submit bookings.</p>
                            <p>If you do not have your Booking Booster affiliate link, please email info@shoreex.com or call us at 866-999-6590 today! </p>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection