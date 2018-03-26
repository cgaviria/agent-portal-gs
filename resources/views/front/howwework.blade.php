@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/howwework.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontHowWeWorkInstance = new ViewsFrontHowWeWork();
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
                    <div id="post-17" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>How we Work with Travel Agents</h1>
                        <div class="entry-content">
                            <p><img src="{{asset('images/working-1.jpg')}}" alt="working" width="724" /></p>
                            <p>If you are currently working with the following platforms, you can easily offer shore excursions and tours to your clients at no additional cost to you.</p>
                            <p>The set-up is very simple. All of these platforms allow you to opt-in for our ‘complimentary marketing emails’ program. When you participate, Shore Excursions Group, on your behalf, starts sending  automated and timed emails reminders offering your cruise passengers to book their shore excursions. In contrast to other tour and shore excursion companies, our technology sends and offers shore excursions aligned only with their cruise itinerary, in every port.  Yes, we do all of the work for you. What a great way to earn more commissions!</p>
                            <p>We work directly with administrators of each platforms and with the headquarters of the agency you represent, so please call or email us to find out <span style="text-decoration: underline;">how</span> your platform works with the Shore Excursion Group services. From the set-up to commission checks, we will answer all your questions and get you started. Please call 866-999-6590 or <a href="mailto:info@shoreex.com" target="_blank">email us.</a></p>
                            <p>Note: If you are not associated or currently working with aforementioned platforms, you can take advantage of our automated marketing email reminders via our proprietary <a href="http://agents.shoreexcursionsgroup.com/booking-booster/">Booking Booster</a> tool.</p>
                            <p>&nbsp;</p>
                            <p><img class="platform-logo" src="{{asset('images/sabre-e1458726548268.png')}}" alt="sabre" width="163" height="40" /><img class="platform-logo" src="{{asset('images/cruisepro-e1458726532862.png')}}" alt="cruisepro" width="181" height="40" /><img class="platform-logo" src="{{asset('images/oncue-e1458726538454.png')}}" alt="oncue" width="184" height="40" /><img class="platform-logo" src="{{asset('images/wincruise-e1458726560655.png')}}" alt="wincruise" width="125" height="40" /><img class="platform-logo" src="{{asset('images/clientbase-e1458726514285.png')}}" alt="clientbase" width="244" height="40" /><img class="platform-logo" src="{{asset('images/intouch-e1458726543443.png')}}" alt="intouch" width="147" height="40" /><img class="platform-logo" src="{{asset('images/cruiedesk-e1458726526118.png')}}" alt="cruiedesk" width="135" height="40" /><img class="platform-logo" src="{{asset('images/Client-Reach.jpg')}}" alt="clientreach" width="244" height="40" /></p>
                            <p>&nbsp;</p>
                            <div style="font-size: 14px;">
                                <div class="accordion-section">
                                    <div id="accordion-1"></div>
                                    <p><!--end .accordion-section-content--></p>
                                </div>
                                <p><!--end .accordion-section--></p>
                            </div>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection