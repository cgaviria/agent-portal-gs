@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/travelagentfaq.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontTravelAgentFAQInstance = new ViewsFrontTravelAgentFAQ();
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
                    <div id="post-23" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Travel Agent FAQ</h1>
                        <div class="entry-content">
                            <p><strong>Why book with Shore Excursions Group?</strong><br />
                                We know that the time in port is one of the most important parts of anyone&#8217;s vacation, so we take our commitment to deliver great shore excursions very seriously. That&#8217;s why shore excursions are our only business. We carefully select only the best tour operators in each port, and, because we are not trying to reserve excursions for thousands of people at a time, in many cases we are able to choose tour providers who carry much smaller groups of travelers on more intimate, personalized experiences. Because we know that it can be confusing to choose the best tour in each port, we have a staff of shore excursion experts available to answer your</p>
                            <p><strong><br />
                                    How large is Shore Excursions Group?</strong><br />
                                Yes, with more than 3,000 excursions in over 300 ports worldwide, we are the largest excursion company in the world. We work with the largest travel agencies in the world and thousands of medium and small agencies.</p>
                            <p><strong><br />
                                    Are your prices lower than the cruise lines’?</strong><br />
                                Our prices are as much as 40% lower than the cruise lines, as well as higher in quality, unlike the cruise line’s crowded excursions; our average excursion size is only 12 people.</p>
                            <p><strong><br />
                                    Do you provide Money Back Guarantee?</strong><br />
                                To the extent your clients are not satisfied with our excursions, yes, we will provide a full refund.</p>
                            <p><strong><br />
                                    Do you Provide Guaranteed Return to Ship?</strong><br />
                                We have never had a customer miss their ship. Our team possesses over 80 years of combined cruise line experience and we are not aware of a single case in which a customer on an independent tour missed a ship. In the extremely unlikely event that you miss your ship due to the late arrival of one of our tours, we will arrange and pay for your accommodations, meals, and transportation to the next port of call, and we will pay you an additional $500 USD per customer for the inconvenience.</p>
                            <p><strong><br />
                                    Do you have a hotline for Travelers?</strong><br />
                                Yes, we provide 24/7 Support for Travelers &#8211; available any time from any place in the world via our toll-free number in the unlikely event your clients encounter any difficulties.</p>
                            <p><strong>How do I sign in to my Shore Excursions account?</strong><br />
                                No Sign-In Necessary to Make Bookings. No need to remember logins and passwords. Our advanced technology automatically tracks your bookings for commission purposes.</p>
                            <p><strong>How does your shore excursions ticketing work?</strong><br />
                                We offer Self-Service Ticketing. Your clients do not need to create an account to book or retrieve their e-tickets!</p>
                            <p><strong><br />
                                    Do you accept in other currencies?</strong><br />
                                Yes, you can book in British Pounds, Canadian dollars, Australian dollars, and Euro.</p>
                            <p><strong>Which booking platforms are connected to ShoreExcursions Group?</strong><br />
                                We have automated connectivity to the Leading Cruise Booking Systems: Client Base Marketing Systems, Sabre, CruisePro, WinCruise, CruiseDesk, OnCue, InTouch, ClientReach and CruiseDesk. Contact us for more info.</p>
                            <p><strong>Do you provide Marketing Support?</strong><br />
                                Of course! We have full private labeling capability. You can get your own shore excursions website. You get access to our free <a href="{{action('FrontController@getBookingBooster')}}">BOOKING BOOSTER</a> tool. We are happy to provide our agency partners free tools to maximize their excursion sales.</p>
                            <p><strong><br />
                                    Do you do Group Excursions?</strong><br />
                                Yes, we love groups and great at it! We offer a wide variety of excursions for your group needs &#8211; whether you&#8217;re coordinating a family or school reunion, bachelor/bachelorette party, or planning a professional seminar for an organization, we offer a great variety of amenities to make your group event unique and unforgettable. Since we are not a large cruise line catering to thousands of customers per day, our group excursions allow you to travel in much smaller groups offering a more personalized experience. For groups of four or more, we can usually arrange a private shore excursion for less than the cost of a large cruise line tour.</p>
                            <p><strong><br />
                                    Do you offer a &#8220;lowest price guarantee&#8221;?</strong><br />
                                YES. We guarantee that our prices are the lowest you can find. If you find a lower price for a tour we offer, we will match it. The Price Match Guarantee will not apply if the cheaper offer is obtained via a limited time promotion, promo code, cash back, coupon, voucher or member’s discount.</p>
                            <p><strong><br />
                                    How does my client receive my booking confirmation and voucher?</strong><br />
                                Shortly after your client reserves a tour, we will e-mail their confirmation which will include the tour vouchers as well as instructions on how and when to meet up with their guide for each tour.</p>
                            <p><strong><br />
                                    What is your cancellation policy?</strong><br />
                                With very few exceptions, you can cancel a tour up to 14 days in advance of tour departure and receive a full refund. The few exceptions to this rule are clearly noted in the tour description. If you would like to cancel a tour, simply give us a call during regular business hours, and we will be happy to assist you. Once you are within the 14 day tour departure window, the tour becomes non-refundable. This is because our operators have set aside space to accommodate your request and will often not be able to fill that space with another customer so close to departure.</p>
                            <p><strong><br />
                                    The website says you can book up to three days prior to my cruise start date. If I want to book my clients within that period, do I have any options?</strong><br />
                                Yes. If you want to book within 3 days of your cruise start date you will need to pay a $25 Expedite Fee.</p>
                            <p><strong><br />
                                    Will you refund my money if my client misses the tour because the ship is late or cannot make it into port?</strong><br />
                                Yes. You your client will receive a full refund for the tour if you cannot make a tour departure due to a ship delay or a missed port call. You will of course also receive a full refund if weather or an equipment problem prevents the tour operator from delivering the tour. Simply let us know within two weeks after the date of the tour, and we will issue a full refund.</p>
                            <p><strong><br />
                                    What are your Customer Service support Hours?</strong><br />
                                You can contact our Help Desk during our regular business hours of 9:00 a.m. &#8211; 6:00 p.m. Monday &#8211; Friday Eastern Standard Time, as well as email us at info@shoreex.com.</p>
                            <p>&nbsp;</p>
                            <p><strong>How much commission do you pay to Travel Agents?</strong><br />
                                We greatly value our travel agency partners, and pay the highest Travel Agency Commissions. Please call us to find out 866-999-6590.</p>
                            <p><strong><br />
                                    How will I know my client booked excursions?<br />
                                </strong>You will be copied on every e-ticket as soon as the tours are confirmed, which includes a summary of charges so you can keep track for commission</p>
                            <p><strong><br />
                                    How and when do I get paid commission?<br />
                                </strong>You get paid commission the 3<sup>rd</sup> week of the month following travel. So if your client takes a tour in June, you would get paid commission on that tour the 3<sup>rd</sup> week of July.</p>
                            <p><strong><br />
                                    Does each agent have to sign up individually with SEG?<br />
                                </strong>No. The agency signs up and there is one main agency link that can be personalized for each agent</p>
                            <p><strong><br />
                                    If my clients book on their own, do I get commission on that too?<br />
                                </strong>Of course! That is why all the links and emails are embedded with your tracking. The whole point is for them to book on their own so you don’t have to do any work.</p>
                            <p><strong><br />
                                    Do you offer Discounts or Savings coupons?<br />
                                </strong>There are several options. Call or email us to discuss (866) 999 6590.<strong><br />
                                </strong></p>
                            <p><strong><br />
                                    What if my clients miss the ship because of your tours?<br />
                                </strong>This has never happened! But we rich guarantee in case this ever happens. If this happens, we will pay ALL costs to get them to the next port of call PLUS we will pay them $500 each for the inconvenience. <a href="http://www.shoreexcursionsgroup.com/our-guarantee-a/137.htm">Read about our guarantees</a>.</p>
                            <p><strong><br />
                                    What if my clients have issues or questions while they are on their cruise?<br />
                                </strong>On every e-ticket there is a number for the local tour operator and also a 24/7 emergency number for them to reach us.</p>
                            <p><strong><br />
                                    What if my customers take your tour and aren’t happy?<br />
                                </strong>Please let us know what happened! We will contact the tour operator to confirm and do whatever it takes to make your clients happy, up to and even including a full refund if that is warranted.</p>
                            <p><strong><br />
                                    What if my client wants a private tour but it’s not offered as private on your site?<br />
                                </strong>Let us know! Lots of tours can be privatized and/or customized. <a href="http://www.shoreexcursionsgroup.com/contact-us-a/134.htm">Contact us.</a></p>
                            <p><strong><br />
                                    You send excursion reminder emails on my behalf. Don’t these emails spam my clients’ emails?<br />
                                </strong>No, we are very careful to make sure that does not happen! They only ever get up to 3 emails. The 1<sup>st</sup> within a week of booking, the 2<sup>nd</sup> 60 days before they sail and the 3<sup>rd</sup> 30 days before they sail. That’s it!</p>
                            <p><strong><br />
                                    Does automating emails to my clients violate the strict spam laws in Canada?<br />
                                </strong>No, our attorneys were very thorough about ensuring that even the strictest spam laws were not violated</p>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection