@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/index.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontIndexInstance = new ViewsFrontIndex();
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
                    <div id="post-13" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Travel Agent Home</h1>
                        <div class="entry-content">
                            <p>
                                <img class="" src="{{asset('images/seg-ta-hp-banner.jpg')}}" alt="tap-hero" width="100%" />
                            </p>
                            <h3>
                                <strong>
                                    We love Travel Agents.
                                </strong>
                            </h3>
                            <p>
                                We recognize that travel agents form the foundation of the travel industry by providing valuable insight and advice to travelers. We have built this portal for you. We are happy to work with you closely and provide added services and personalized attention we believe are beneficial to both you and your customers.
                            </p>
                            <p>
                                Shore Excursions Group has the largest selection of shore excursions in the world &#8211; over 3,000 excursions in over 300 ports. We work with over 500 hand-picked tour providers worldwide, and offer more than 800 discounted, multi-port excursion packages.
                            </p>
                            <p>
                                Here’s why Travel Agents choose Shore Excursions Group:
                            </p>
                            <p>
                                <strong>&#8211; Lower Prices than the Cruise Lines </strong>&#8211; our prices are lower than the cruise lines, sometimes as much as 40% lower.
                                <br />
                                <strong>&#8211; Higher Quality than the Cruise Lines and Smaller-size Tours &#8211; </strong>in contrast to the cruise line tours that routinely travel with more than 50 people per tour, our average tour size is only 12 people, offering a far more personalized and enjoyable experience.
                                <br />
                                <strong>&#8211; Money Back Guarantee &#8211; </strong>to the extent you are not satisfied with excursions you participate in; we will provide a full refund.
                                <br />
                                <strong>&#8211; We offer a &#8220;lowest price guarantee&#8221; </strong>We guarantee that our prices are the lowest you can find. If you find a lower price for a tour we offer, we will match it.
                                <br />
                                <strong>&#8211; 24/7 Support for Travelers </strong>&#8211; we are available any time from any place in the world in the unlikely event you encounter any difficulties.
                                <br />
                                <strong>&#8211; Guaranteed Return to Ship &#8211;  </strong>our team possesses over 80 years of combined cruise line experience and we have never had a customer miss their ship.
                                <br />
                                <strong>&#8211; Easy to Find Excursions &#8211; </strong>We provide detailed information on how to easily find our local representative when you in port.
                            </p>
                            <p>
                                <strong>
                                    <br />
                                    We work with the world’s leading cruise booking engines and platforms:
                                </strong>
                                <br />
                                If you currently work with any of the following products, you can easily take advantage of the marketing tools provided at no additional cost to you. The participation and set-up is super easy. <a href="http://agents.shoreexcursionsgroup.com/working-with-us/">Learn more</a> about how we work with each platform.
                            </p>
                            <p>
                                <img class="platform-logo" src="{{asset('images/sabre-e1458726548268.png')}}" alt="sabre" width="163" height="40" />
                                <img class="platform-logo" src="{{asset('images/cruisepro-e1458726532862.png')}}" alt="cruisepro" width="181" height="40" />
                                <img class="platform-logo" src="{{asset('images/oncue-e1458726538454.png')}}" alt="oncue" width="184" height="40" />
                                <img class="platform-logo" src="{{asset('images/wincruise-e1458726560655.png')}}" alt="wincruise" width="125" height="40" />
                                <img class="platform-logo" src="{{asset('images/clientbase-e1458726514285.png')}}" alt="clientbase" width="244" height="40" />
                                <img class="platform-logo" src="{{asset('images/intouch-e1458726543443.png')}}" alt="intouch" width="147" height="40" />
                                <img class="platform-logo" src="{{asset('images/cruiedesk-e1458726526118.png')}}" alt="cruiedesk" width="135" height="40" />
                                <img class="platform-logo" src="{{asset('images/Client-Reach.jpg')}}" alt="clientreach" width="244" height="40" />
                            </p>
                        </div>
                        <!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div>
                    <!-- .hentry -->
                </div>
                <!-- .hfeed -->
            </div>
            <!-- #content -->
        </div>
        <!-- .content-wrap -->
    </div>
@endsection