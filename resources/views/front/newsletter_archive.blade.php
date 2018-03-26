@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/newsletterarchive.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontNewsletterArchiveInstance = new ViewsFrontNewsletterArchive();
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
                    <div id="post-29" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Travel Agent Newsletters</h1>
                        <div class="entry-content">
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Cruise-Industry-Expansion.pdf')}}" target="_blank">Cruise Industry Expansion!</a><br />
                                More than 50 new cruise ships are expected to be launched through 2020</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Customer-Buying-Trends-Promotions-Increase-Sales.pdf')}}" target="_blank">Customer Buying Trends. Promotions Increase Sales.</a><br />
                                A recent CLIA report found that cruisers believe the best cruise pricing can be found online, but also recognize that its not always all about the price.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Cruise-Trends-to-Keep-an-Eye-On.pdf')}}" target="_blank">Cruise Trends to Keep an Eye On.</a><br />
                                Looking for the latest and greatest developments for cruising?</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Changes-in-Airline-Miles-Programs.pdf')}}" target="_blank">Changes in Airline Miles Programs.</a><br />
                                Don&#8217;t let your clients get caught off guard &#8212; big changes are happening</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Pre-and-Post-Cruise-Activities-on-the-Rise-.pdf')}}" target="_blank">Pre and Post-Cruise Activities on the Rise</a><br />
                                It&#8217;s all in the family! Multi-generational travel continues to grow in popularity.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Cruise-Lines-Are-Expanding-Destinations.pdf')}}" target="_blank">Cruise Lines Are Expanding Destinations.</a><br />
                                Many traditional cruise destinations like the Caribbean and Alaska are reaching maximum capacity.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/The-No-1-Destinations-for-Cruisers.pdf')}}" target="_blank">The No.1 Destination for Cruisers.</a><br />
                                The beautiful islands of the Caribbean remain the number-one destination for cruisers around the globe</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/More-People-Cruising-to-South-America.pdf')}}" target="_blank">More People Cruising to South America.</a><br />
                                South America offers an exciting new destination experience.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Are-You-Targeting-Millennials-Why-You-Should.pdf')}}" target="_blank">Are You Targeting Millennials? Why You Should.</a><br />
                                A love for travel transcends age, however, it may pay for you to target certain age groups.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Group-Excursions-Are-Making-a-Comeback.pdf')}}" target="_blank">Group Excursions Are Making a Comeback.</a><br />
                                Group travel has made a comeback in 2015. It&#8217;s hard to believe that just two years ago, group travel was at its lowest point in many years!</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/One-of-Our-Favorite-Travel-Quotes.pdf')}}" target="_blank">One of Our Favorite Travel Quotes.</a><br />
                                “Traveling – It leaves you speechless, then turns you into a storyteller.”</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Updates-and-whats-coming-up.pdf')}}" target="_blank">Updates and what&#8217;s coming up!</a><br />
                                Aloha, everyone! The Hawaiian cruise season is just around the corner, so hopefully you can take advantage of this market trend by selling some Hawaiian cruises!</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Top-5-Tips-for-Travel-Agency-Marketing.pdf')}}" target="_blank">Top 5 Tips for Travel Agency Marketing.</a><br />
                                Your clients rely on you to help them book the perfect vacations, and this means they trust your suggestions.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Theres-a-Money-Tree-in-This-Email.pdf')}}" target="_blank">There&#8217;s a Money Tree in This Email.</a><br />
                                With 2015 fully underway, we wanted to share some of our goals and resolutions with you, and also suggest a couple you should set for yourselves.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Europe-Shore-Excursion-Predictions.pdf')}}" target="_blank">Europe Shore Excursion Predictions.</a><br />
                                2015 is projected to be a very strong year for European cruises.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Discovering-the-Land-Down-Under.pdf')}}" target="_blank">Discovering the Land Down Under.</a><br />
                                Australia also continues to experience record growth.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Using-Promotions-to-Increase-Commission.pdf')}}" target="_blank">Using Promotions to Increase Commission.</a><br />
                                Promotions and discounts are an effective way to increase sales in the travel industry.</p>
                            <p><a style="font-size: 16px;" href="{{asset('pdf/Top-10-Reasons-Why-People-Like-Cruising.pdf')}}" target="_blank">Top 10 Reasons Why People Like Cruising.</a><br />
                                Promoting cruise vacations to your clients is easy!</p>
                            <p>&nbsp;</p>
                            <h2> Sign up for our <a href="http://www.shoreexcursionsgroup.com/-a/262.htm"><strong><u>Travel Agent Newsletter here</strong></u></a></h2>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection