<!DOCTYPE html>
<html lang="en-US">
    @include('header.front')
    <body class="wordpress ltr en_US parent-theme y2018 m02 d22 h14 thursday logged-out custom-header home singular singular-page singular-page-13 page-template-default no-js">
        <div id="container">
            <div class="wrap">
                @yield('content')
                @include('footer.front')
            </div>
            <!-- .wrap -->
        </div>


        <!-- #container -->
        <script type='text/javascript' src='{{asset('js/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var _wpcf7 = {"loaderUrl":"{{str_replace('/', '\/', asset('images/ajax-loader.gif'))}}","recaptchaEmpty":"Please verify that you are not a robot.","sending":"Sending ..."};
            /* ]]> */
        </script>
        <script type='text/javascript' src='{{asset('js/wp-content/plugins/contact-form-7/includes/js/scripts.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/jquery.imagesloaded.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/jquery.masonry.min.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/cycle/jquery.cycle.min.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/fitvids/jquery.fitvids.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/navigation.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var slider_settings = {"timeout":"6000"};
            /* ]]> */
        </script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/js/footer-scripts-light.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-content/themes/oxygen/library/js/drop-downs.min.js?'.Config::get('app.cache_buster'))}}'></script>
        <script type='text/javascript' src='{{asset('js/wp-includes/js/wp-embed.min.js?'.Config::get('app.cache_buster'))}}'></script>

        <script src="{{asset('js/views/layouts/front.js?'.Config::get('app.cache_buster'))}}"></script>
        <script>
            var ViewsLayoutsFrontInstance = new ViewsLayoutsFront();
        </script>
    </body>
</html>