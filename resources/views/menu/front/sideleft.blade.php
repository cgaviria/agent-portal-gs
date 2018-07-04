<div class="aside">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <style>
            .button {
                border: none;
                color: #ffffff;
                padding: 16px 0;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 13px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
                border-radius: 4px;
                width:100%;
                font-family: 'Open Sans', Helvetica, Arial, sans-serif;
                font-weight:bold;
            }

            .button1 {
                color: #ffffff;
                background: #40b84a; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#40b84a, #007536); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#40b84a, #007536); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#40b84a, #007536); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#40b84a, #007536); /* Standard syntax */
            }

            .button1:hover {
                background: #007536; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#007536, #40b84a); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#007536, #40b84a); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#007536, #40b84a); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#007536, #40b84a); /* Standard syn */
            }

            .button2 {
                color: #ffffff;
                background: #a95a00; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#ffa400, #a95a00); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#ffa400, #a95a00); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#ffa400, #a95a00); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#ffa400, #a95a00); /* Standard syntax */
            }

            .button2:hover {
                background: #ffa400; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#a95a00, #ffa400); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#a95a00, #ffa400); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#a95a00, #ffa400); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#a95a00, #ffa400); /* Standard syn */
            }

            .button3 {
                color: #ffffff;
                background: #a572c5; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#a572c5, #652191); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#a572c5, #652191); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#a572c5, #652191); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#a572c5, #652191); /* Standard syntax */
            }
            .button3:hover {
                background: #652191; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#652191, #a572c5); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#652191, #a572c5); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#652191, #a572c5); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#652191, #a572c5); /* Standard syn */
            }

            @media only screen and (max-width: 768px) {
                .sidecta {
                    display:none;
                }
            }
        </style>
    </head>
    <div id="menu-secondary" class="site-navigation menu-container" role="navigation">
        <span class="menu-toggle">
            Travel Agent Links
        </span>
        <div class="wrap2">
            <div class="menu">
                <ul id="menu-secondary-items" class="nav-menu">
                    <li id="menu-item-622" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-622">
                        <a target="_blank" href="https://www.shoreexcursionsgroup.com/travel-agents-signup">
                            New Agent Sign Up
                        </a>
                    </li>
                    <li id="menu-item-623" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-623">
                        <a target="_blank" href="https://www.shoreexcursionsgroup.com/contact-us">
                            Request a Training
                        </a>
                    </li>
                    <li id="menu-item-48" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48">
                        <a href="{{action('FrontController@getHowWeWork')}}">
                            How we Work with Travel Agents
                        </a>
                    </li>
                    <li id="menu-item-47" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-47">
                        <a href="{{action('FrontController@getGroups')}}">
                            Groups
                        </a>
                    </li>
                    <li id="menu-item-44" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-44">
                        <a href="{{action('FrontController@getMediaCenter')}}">
                            Media Center
                        </a>
                    </li>
                    <li id="menu-item-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42">
                        <a href="{{action('FrontController@getNewsletterArchive')}}">
                            Newsletter Archive
                        </a>
                    </li>
                    <li id="menu-item-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41">
                        <a href="{{action('FrontController@getWebinarsAndEvents')}}">
                            Webinars &amp; Events
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu-secondary .menu-container -->
    <div class="sidecta">
        <div style="padding-bottom:14px;">
            <a href="https://www.shoreexcursionsgroup.com/travel-agents-signup" style="text-decoration:none;">
                <button class="button button1">NEW AGENT SIGN UP &nbsp;<img src="http://agents.shoreexcursionsgroup.com/wp-content/uploads/2016/03/playicon.png" width="20" height="20"></button>
            </a>
        </div>
        <div style="padding-bottom:14px;">
            <a href="{{action('FrontController@getCustomerReviews')}}" style="text-decoration:none;">
                <button class="button button2">CUSTOMER REVIEWS &nbsp;<img src="http://agents.shoreexcursionsgroup.com/wp-content/uploads/2016/03/playicon.png" width="20" height="20"></button>
            </a>
        </div>
        <div style="padding-bottom:14px;">
            <a href="{{action('FrontController@getTravelAgentFAQ')}}" style="text-decoration:none;">
                <button class="button button3">AGENT FAQs &nbsp;<img src="http://agents.shoreexcursionsgroup.com/wp-content/uploads/2016/03/playicon.png" width="20" height="20"></button>
            </a>
        </div>
        <!--
        <div style="padding-bottom:14px;">
        <a href="#" style="text-decoration:none;"><button class="button button4">HELP DESK &nbsp;<img src="http://agents.shoreexcursionsgroup.com/wp-content/uploads/2016/03/playicon.png" width="20" height="20"></button></a>
        </div>
        -->
    </div>
</div>