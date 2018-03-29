<!DOCTYPE html>
<html lang="en">
    @include('header.login')
    <body>
        @yield('content')
        <!-- build:js(../app) js/vendor-user.js-->
        <!-- Modernizr-->
        <script src="{{asset('js/modernizr.custom.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery-->
        <script src="{{asset('js/jquery.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Bootstrap-->
        <script src="{{asset('js/bootstrap.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery Browser-->
        <script src="{{asset('js/jquery.browser.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Material Colors-->
        <script src="{{asset('js/colors.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery Form Validation-->
        <script src="{{asset('js/jquery.validate.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/additional-methods.js?'.Config::get('app.cache_buster'))}}"></script>
        <!--Noty-->
        <script src="{{asset('js/vendor/needim/noty/lib/noty.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Class.js-->
        <script src="{{asset('js/class.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- endbuild-->
        <!-- App script-->
        <script src="{{asset('js/app_login.js?'.Config::get('app.cache_buster'))}}"></script>

        <script src="{{asset('js/views/globals.js?'.Config::get('app.cache_buster'))}}"></script> 
         <script>
            var viewsGlobalInstance = new ViewsGlobals();
        </script>
        <!--login-->
        <script src="{{asset('js/views/header/login.js?'.Config::get('app.cache_buster'))}}"></script> 
        <script>
            var viewsLoginInstance = new ViewsLayoutsLogin();
        </script>
    </body>
</html>