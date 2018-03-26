@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/groups.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontGroupsInstance = new ViewsFrontGroups();
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
                    <div id="post-19" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Groups</h1>
                        <div class="entry-content">
                            <p><img src="{{asset('images/group.jpg')}}" alt="group" width="724" /></p>
                            <h4><strong>With more than 3,000 excursions in over 300 ports, we&#8217;re proud to be the largest shore excursion company in the travel industry.</strong></h4>
                            <p>We offer a wide variety of excursions for your group from cultural experiences to active adventures and everything in between. Whether you&#8217;re coordinating a family or school reunion, bachelor/bachelorette party, or planning a professional seminar for an organization, Shore Excursions Group offers you fantastic group rates and a great variety of amenities to make your group event unique and unforgettable.</p>
                            <p>Our Shore Excursions group sizes range anywhere from four and more, and provide a more personalized experience. Since we are not a large cruise line catering to thousands of customers per day, our group excursions allow you to travel in much smaller groups offering a more personalized experience.</p>
                            <p>Our Group Experts will work closely with you to choose the excursions that best meet the interests, activity level and budget of your group members. Whether your group is large or small, from relaxing to exhilarating, private or custom tours in most ports, Shore Excursions Group will accommodate them all.</p>
                            <p><img class="alignright size-medium wp-image-176" src="{{asset('images/group-example-page2.jpg')}}" alt="group-example-page2" width="300" /></p>
                            <h4><strong>Why Book Group Excursions with Us:</strong></h4>
                            <ul class="grouplist" style="list-style: disc;">
                                <li>We are the largest shore excursion company in the world with more than 3,000 excursions in over 300 ports.</li>
                                <li>Our group excursions are lower priced and higher quality than those offered by the cruise lines.</li>
                                <li>More than 800 discounted, multi-port excursion packages. These are customer favorites!</li>
                                <li>We offer worry &#8211; free tour arrangements</li>
                                <li>Our Groups Excursion team helps you with all the details of your special event, from start to finish.</li>
                                <li>We can customize our groups based on your needs, and will work within your budget.</li>
                                <li>We offer priority departure times, and language specific guides (upon request) in most ports.</li>
                                <li>We provide exclusive coaches/transportation for the group (upon request).</li>
                                <li>24/7 traveler support for your group so you can book with confidence.</li>
                                <li>Over 8,000 top-rated satisfied customer reviews for our excursions.</li>
                                <li>Get a FREE, fun, customized website for your group of 20 or more guests.</li>
                            </ul>
                            <p>We look forward to working with you on your group!</p>
                            <p><strong>READY TO START PLANNING YOUR GROUP SHORE EXCURSION?<br />
                                    Request a Quote at <a href="mailto:groups@shoreex.com?Subject=SEG TA Portal|%20Group%20Quote%20Request">Request a Quote</a></strong></p>
                            <p style="font-size: 12px; line-height: 125%;">Note: All itineraries, availability and prices are current at the time of quote and subject to change without notice. Certain restrictions apply. Excursions are subject to availability depending on the number of participants, time frame in which they are requested and previous commitment of shuttles, buses, boats, etc. Additional costs may apply.</p>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection