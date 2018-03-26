@extends('layouts.front')
@section('content')
    <script src="{{asset('js/views/front/mediacenter.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsFrontMediaCenterInstance = new ViewsFrontMediaCenter();
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
                    <div id="post-25" class="hentry page publish post-1 odd author-rnoel">
                        <h1 class='page-title entry-title'>Media Center</h1>
                        <div class="entry-content">
                            <div>
                                <div class="accordion-section"><img class="alignnone wp-image-749 size-full" src="{{asset('images/underwater.jpg')}}" alt="underwater" width="724" height="278" srcset="{{asset('images/underwater-300x115.jpg')}} 300w, {{asset('images/underwater.jpg')}} 724w" sizes="(max-width: 724px) 100vw, 724px" /></div>
                            </div>
                            <div class="accordion-section">
                                <p><strong>Online Banners</strong></p>
                                <p>Your clients are already visiting your site, and now you can advertise shore excursions with ready-to-go banners on your website!</p>
                                <p>We&#8217;ve included a large variety of banners in all different sizes and styles for you to choose from, and we&#8217;ll be adding more all the time. So keep checking back to make sure you have the latest and greatest tiles on your site!</p>
                                <p>Adding shore excursions banners to your site and making it so they click to your personal booking link can boost your bookings &#8212; and your commissions!</p>
                                <p>&nbsp;</p>
                            </div>
                            <div>
                                <div class="accordion-section">
                                    <p><span class="media-section-title"><strong>Brand Logos</strong></span></p>
                                    <div id="accordion-1" style="padding-left: 8px;">
                                        <div class="mediatile2"><img style="padding: 0 20px 10px 0;" src="{{asset('images/seg-logo.png')}}" alt="SEG-LOGO" width="250" height="auto" /><br />
                                            <strong>Web Format</strong><span style="padding: 0 8px;">|</span><a href="{{asset('zip/SEG-Logo.zip')}}">Download JPG</a></div>
                                        <div class="mediatile2"><img style="padding: 0 20px 10px 0;" src="{{asset('images/seg-logo.png')}}" alt="SEG-LOGO" width="250" height="auto" /><br />
                                            <strong>Print Format</strong><span style="padding: 0 8px;">|</span><a href="{{asset('zip/SEG-Logo.zip')}}">Download EPS</a></div>
                                        <div class="mediatile2"><img style="padding: 0 20px 10px 0;" src="{{asset('images/SEG-Logo-BW.jpg')}}" alt="SEG-LOGO" width="250" height="auto" /><br />
                                            <strong>Web Format</strong><span style="padding: 0 8px;">|</span><a href="{{asset('images/SEG-Logo-BW.jpg')}}">Download JPG</a></div>
                                        <div class="mediatile2"><img style="padding: 0 20px 10px 0;" src="{{asset('images/SEG-Logo-BW.jpg')}}" alt="SEG-LOGO" width="250" height="auto" /><br />
                                            <strong>Print Format</strong><span style="padding: 0 8px;">|</span><a href="{{asset('zip/SEG-Logo-BW.zip')}}">Download EPS</a></div>
                                        <div class="mediatile2"><img style="padding: 0 20px 10px 0;" src="{{asset('images/seg-icon-lg.png')}}" alt="SEG-LOGO" width="48" height="auto" /><br />
                                            <strong>Logomark</strong><span style="padding: 0 8px;">|</span><a href="{{asset('images/seg-icon-lg.png')}}">Download PNG</a></div>
                                    </div>
                                </div>
                                <p>&nbsp;</p>
                                <div class="accordion-section">
                                    <table border="0" cellspacing="0" cellpadding="14" align="left">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div style="width: 100%; float: left; padding-bottom: 20px;">
                                                    <hr />
                                                </div>
                                                <div style="width: 100%; float: left; padding-bottom: 20px; font-weight: bold;"></div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/best-300x250.jpg')}}" alt="300x250-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTriggerOne" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/best-300x250.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContentOne" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 300px Height = 250px</span><br /><img src="{{asset('images/best-300x250.jpg')}}" alt="300x250-TILE" width="300" height="250" /></p>
                                                            <p><a href="{{asset('images/best-300x250.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayCloseOne" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/YUMG3NKMIREL5LYRNLY3K6.jpg')}}" alt="150x150-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTriggerTwo" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/YUMG3NKMIREL5LYRNLY3K6.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContentTwo" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 300px Height = 250px</span><br /><img src="{{asset('images/YUMG3NKMIREL5LYRNLY3K6.jpg')}}" alt="150x150-TILE" width="300" height="250" /></p>
                                                            <p><a href="{{asset('images/YUMG3NKMIREL5LYRNLY3K6.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayCloseTwo" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/best-300x250_europe.jpg')}}" alt="300x250-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger3" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/best-300x250_europe.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent3" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 300px Height = 250px</span><br /><img src="{{asset('images/best-300x250_europe.jpg')}}" alt="300x250-TILE" width="300" height="250" /></p>
                                                            <p><a href="{{asset('images/best-300x250_europe.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose3" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/JXI4HKJP2BFFTAWOYDSBCO.jpg')}}" alt="300x250-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger4" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/best-300x250_europe.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent4" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 300px Height = 250px</span><br /><img src="{{asset('images/JXI4HKJP2BFFTAWOYDSBCO.jpg')}}" alt="300x250-TILE" width="300" height="250" /></p>
                                                            <p><a href="{{asset('images/JXI4HKJP2BFFTAWOYDSBCO.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose4" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/JHHXNEYWYJHOHO5VWHZXK4.jpg')}}" alt="300x250-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger5" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/JHHXNEYWYJHOHO5VWHZXK4.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent5" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 300px Height = 250px</span><br /><img src="{{asset('images/JHHXNEYWYJHOHO5VWHZXK4.jpg')}}" alt="300x250-TILE" width="300" height="250" /></p>
                                                            <p><a href="{{asset('images/JHHXNEYWYJHOHO5VWHZXK4.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose5" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left; padding-bottom: 20px;">
                                                    <hr />
                                                </div>
                                                <div style="width: 100%; float: left; padding-bottom: 20px; font-weight: bold;"></div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/150x150-TILE.jpg')}}" alt="150x150-TILE" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger7" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/150x150-TILE.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent7" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 150px Height = 150px</span><br /><img src="{{asset('images/150x150-TILE.jpg')}}" alt="150x150-TILE" width="150" height="150" /></p>
                                                            <p><a href="{{asset('images/150x150-TILE.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose7" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left; padding-bottom: 20px;">
                                                    <hr />
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/best-160x600.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger8" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/best-160x600.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent8" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 160px Height = 600px</span><br /><img src="{{asset('images/best-160x600.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="600" /></p>
                                                            <p><a href="{{asset('images/best-160x600.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose8" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/YHYH7HKFWVHDHFJ6YGMENN.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger10" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/YHYH7HKFWVHDHFJ6YGMENN.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent10" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 160px Height = 600px</span><br /><img src="{{asset('images/YHYH7HKFWVHDHFJ6YGMENN.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="600" /></p>
                                                            <p><a href="{{asset('images/YHYH7HKFWVHDHFJ6YGMENN.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose10" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile">
                                                    <div><img src="{{asset('images/7VROKLRK2FFOFBBHK6F4ZG.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger11" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/7VROKLRK2FFOFBBHK6F4ZG.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent11" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 160px Height = 600px</span><br /><img src="{{asset('images/7VROKLRK2FFOFBBHK6F4ZG.jpg')}}" alt="160x600-SKYSCRAPER" width="160" height="600" /></p>
                                                            <p><a href="{{asset('images/7VROKLRK2FFOFBBHK6F4ZG.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose11" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left; padding-bottom: 20px;">
                                                    <hr />
                                                </div>
                                                <div class="mediatile3">
                                                    <div><img src="{{asset('images/U3TSUBQAKJHBNFXIHAZQXI.jpg')}}" alt="728x90" width="auto" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger12" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/U3TSUBQAKJHBNFXIHAZQXI.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent12" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 728px Height = 90px</span><br /><img src="{{asset('images/U3TSUBQAKJHBNFXIHAZQXI.jpg')}}" alt="728x90" width="auto" height="auto" /></p>
                                                            <p><a href="{{asset('images/U3TSUBQAKJHBNFXIHAZQXI.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose12" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile3">
                                                    <div><img src="{{asset('images/WLJQ7BZ6FFDFJHFDWGV4MK.jpg')}}" alt="728x90" width="auto" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger13" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/WLJQ7BZ6FFDFJHFDWGV4MK.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent13" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 728px Height = 90px</span><br /><img src="{{asset('images/WLJQ7BZ6FFDFJHFDWGV4MK.jpg')}}" alt="728x90" width="auto" height="auto" /></p>
                                                            <p><a href="{{asset('images/WLJQ7BZ6FFDFJHFDWGV4MK.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose13" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile3">
                                                    <div><img src="{{asset('images/PGGNRRKYINCGZBHUVOVNVO.jpg')}}" alt="728x90" width="auto" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger14" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/PGGNRRKYINCGZBHUVOVNVO.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent14" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 728px Height = 90px</span><br /><img src="{{asset('images/PGGNRRKYINCGZBHUVOVNVO.jpg')}}" alt="728x90" width="auto" height="auto" /></p>
                                                            <p><a href="{{asset('images/PGGNRRKYINCGZBHUVOVNVO.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose14" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mediatile3">
                                                    <div><img src="{{asset('images/MTQLMIDRXVAA7GAEZ2E6TJ.jpg')}}" alt="728x90" width="auto" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                    <div>
                                                        <p><span id="overlayTrigger15" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/MTQLMIDRXVAA7GAEZ2E6TJ.jpg')}}" target="_blank">Download</a></p>
                                                        <div id="overlayContent15" style="display: none;">
                                                            <p><span class="web-developer-display-image-dimensions">Width = 728px Height = 90px</span><br /><img src="{{asset('images/MTQLMIDRXVAA7GAEZ2E6TJ.jpg')}}" alt="728x90" width="auto" height="auto" /></p>
                                                            <p><a href="{{asset('images/MTQLMIDRXVAA7GAEZ2E6TJ.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                                <button id="overlayClose15" class="overlay-close">X</button></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p><!--end .accordion-section--></p>
                            <p>&nbsp;</p>
                            <div class="accordion-section">
                                <p><span class="media-section-title"><strong>Print Media</strong></span></p>
                                <div id="accordion-3">
                                    <table border="0" cellspacing="0" cellpadding="14" align="left">
                                        <tbody>
                                        <tr>
                                            <td>Why not give your clients a beautiful full-color handout letting them know how to book their excursions with you? They may not be ready to book right this second, but when they are, they&#8217;ll have your splashy handout at home with them &#8211; and know just where to go to book.</p>
                                                <p>It&#8217;s super easy to print these out, and you can even write your own personal contact information on them to customize them even more!</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div><img src="{{asset('images/buckslip_SEGonly.jpg')}}" alt="BUCKSLIP" width="80" height="auto" /><span style="padding: 0 0 0 20px;"> </span></div>
                                                <div><strong>Buckslip</strong><br />
                                                    <span id="overlayTrigger16" class="overlay-link"><a href="#">Preview</a></span><span style="padding: 0 8px;">|</span><a href="{{asset('images/buckslip_SEGonly.jpg')}}" target="_blank">Download</a></p>
                                                    <div id="overlayContent16" style="display: none;">
                                                        <p><span class="web-developer-display-image-dimensions">Width = 1050px Height = 2550px</span><br /><img src="{{asset('images/buckslip_SEGonly.jpg')}}" alt="BUCKSLIP" /></p>
                                                        <p><a href="{{asset('images/buckslip_SEGonly.jpg')}}" target="_blank">Right Click to Download</a><br />
                                                            <button id="overlayClose16" class="overlay-close">X</button></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p><!--end .accordion-section-content--></p>
                            </div>
                            <p><!--end .accordion-section--></p>
                            <p><script src="{{asset('js/wp-content/themes/oxygen/jquery-2.1.4.min.js')}}"></script><br />
                                <script src="{{asset('js/wp-content/themes/oxygen/overlay.js')}}"></script><br />
                                <script>// <![CDATA[
                                    jQuery('.overlay-link a').click(function(e) { e.preventDefault(); });
                                    var overlayOne = $('#overlayContentOne').overlay({ overlayTriggerId: "#overlayTriggerOne", overlayCloseId: "#overlayCloseOne" }); //overlayOne.destroy();
                                    var overlayTwo = $('#overlayContentTwo').overlay({ overlayTriggerId: "#overlayTriggerTwo", overlayCloseId: "#overlayCloseTwo" }); //overlayTwo.destroy();
                                    var overlay3 = $('#overlayContent3').overlay({ overlayTriggerId: "#overlayTrigger3", overlayCloseId: "#overlayClose3" }); //overlay3.destroy();
                                    var overlay4 = $('#overlayContent4').overlay({ overlayTriggerId: "#overlayTrigger4", overlayCloseId: "#overlayClose4" }); //overlay4.destroy();
                                    var overlay5 = $('#overlayContent5').overlay({ overlayTriggerId: "#overlayTrigger5", overlayCloseId: "#overlayClose5" }); //overlay5.destroy();
                                    var overlay6 = $('#overlayContent6').overlay({ overlayTriggerId: "#overlayTrigger6", overlayCloseId: "#overlayClose6" }); //overlay6.destroy();
                                    var overlay7 = $('#overlayContent7').overlay({ overlayTriggerId: "#overlayTrigger7", overlayCloseId: "#overlayClose7" }); //overlay7.destroy();
                                    var overlay8 = $('#overlayContent8').overlay({ overlayTriggerId: "#overlayTrigger8", overlayCloseId: "#overlayClose8" }); //overlay8.destroy();
                                    var overlay9 = $('#overlayContent9').overlay({ overlayTriggerId: "#overlayTrigger9", overlayCloseId: "#overlayClose9" }); //overlay9.destroy();
                                    var overlay10 = $('#overlayContent10').overlay({ overlayTriggerId: "#overlayTrigger10", overlayCloseId: "#overlayClose10" }); //overlay10.destroy();
                                    var overlay11 = $('#overlayContent11').overlay({ overlayTriggerId: "#overlayTrigger11", overlayCloseId: "#overlayClose11" }); //overlay11.destroy();
                                    var overlay12 = $('#overlayContent12').overlay({ overlayTriggerId: "#overlayTrigger12", overlayCloseId: "#overlayClose12" }); //overlay12.destroy();
                                    var overlay13 = $('#overlayContent13').overlay({ overlayTriggerId: "#overlayTrigger13", overlayCloseId: "#overlayClose13" }); //overlay13.destroy();
                                    var overlay14 = $('#overlayContent14').overlay({ overlayTriggerId: "#overlayTrigger14", overlayCloseId: "#overlayClose14" }); //overlay14.destroy();
                                    var overlay15 = $('#overlayContent15').overlay({ overlayTriggerId: "#overlayTrigger15", overlayCloseId: "#overlayClose15" }); //overlay15.destroy();
                                    var overlay16 = $('#overlayContent16').overlay({ overlayTriggerId: "#overlayTrigger16", overlayCloseId: "#overlayClose16" }); //overlay16.destroy();
                                    // ]]&gt;</script><br />
                                <script type="text/javascript">// <![CDATA[
                                    var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-36251023-1']); _gaq.push(['_setDomainName', 'jqueryscript.net']); _gaq.push(['_trackPageview']); (function () { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();
                                    // ]]&gt;</script></p>
                        </div><!-- .entry-content -->
                        <div class="entry-meta"></div>
                    </div><!-- .hentry -->
                </div><!-- .hfeed -->
            </div><!-- #content -->
        </div><!-- .content-wrap -->
    </div>
@endsection