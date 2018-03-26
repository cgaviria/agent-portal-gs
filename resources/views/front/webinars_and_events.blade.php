@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/webinarsandevents.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontWebinarsAndEventsInstance = new ViewsFrontWebinarsAndEvents();
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
                    <div id="post-31" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Travel Agent Webinars and Events</h1>
                        <div class="entry-content">
                            <h2><strong>Webinars</strong></h2>
                            <p>Get the latest news and updates on new tools, tours, ports and more with our quick and educational webinars.</p>
                            <p>Here&#8217;s one of our most popular Take-10 webinars we would like to share with you, &#8220;<strong>BECOME A PROMOTIONS PRO&#8221; </strong>which teaches you the secret to using coupons and promotions to boost your overall cruise bookings and increase your total commissions. Enjoy the recorded webinar.</p>
                            <p><iframe src="https://player.vimeo.com/video/126293072" width="500" height="281" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
                            <hr />
                            <p>See the list of our future scheduled Webinars. If you would like to schedule a training webinar for your agency, let us know by <a href="http://www.shoreexcursionsgroup.com/contact-us-a/134.htm">filling out this form</a>.</p>
                            <h2><strong>Events</strong></h2>
                            <p>Currently no events are scheduled. Stay tuned for more updates.</p>
                            <p>If you have questions or concerns, or would like to REQUEST A TRAINING for tour agency, please call us at <a href="tel://8669996590">866-999-6590</a> or email us at <a href="mailto:info@shoreex.com">info@shoreex.com</a>.</p>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection