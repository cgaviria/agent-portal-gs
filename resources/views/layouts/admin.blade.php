<!DOCTYPE html>
<html lang="en">
    @include('header.admin')
    <body class="theme-1">
        <div class="layout-container">
            <!-- top navbar-->
            <header class="header-container">
                <nav>
                    <ul class="visible-xs visible-sm">
                        <li><a class="menu-link menu-link-slide" id="sidebar-toggler" href="#"><span><em></em></span></a></li>
                    </ul>
                    <ul class="hidden-xs">
                        <li><a class="menu-link menu-link-slide" id="offcanvas-toggler" href="#"><span><em></em></span></a></li>
                    </ul>
                    <h2 class="header-title">Web Portal</h2>
                    <ul class="pull-right">
                        @if ($logged_in_user = Sentinel::getUser())
                        @endif
                        @if ($agency = $logged_in_user->getAgency())
                            <li class="agency-name">{{$agency->name}}</li>
                        @elseif ($logged_in_user->inRole(\App\Role::ROLE_ADMIN))
                            <li class="agency-name">System Administrator</li>
                        @elseif ($logged_in_user->inRole(\App\Role::ROLE_OWNER))
                            <li class="agency-name">Agency Owner</li>
                        @endif
                        <li class="dropdown"><a class="dropdown-toggle has-badge ripple" href="#" data-toggle="dropdown"><em class="ion-person"></em></a>
                            <ul class="dropdown-menu dropdown-menu-right md-dropdown-menu">
                                <li><a href="{{URL::action('UsersController@getMyAccount')}}"><em class="ion-home icon-fw"></em>My Account</a></li>
                                <li class="divider" role="presentation"></li>
                                <li><a href="{{URL::action('AuthController@logout')}}"><em class="ion-log-out icon-fw"></em>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
            <!-- sidebar-->
            <aside class="sidebar-container">
                <div class="sidebar-header">
                    <div class="pull-right pt-lg text-muted hidden"><em class="ion-close-round"></em></div><a href="#"><img src="{{asset('images/logo_white_text.png')}}" alt="Logo"></a>
                </div>
                <div class="sidebar-content">
                    <div class="sidebar-toolbar text-center">
                        @if ($user_login->photo)
                            <img class="img-circle thumb64" src="{{asset(((!empty($user_login->image_thumbnails[\App\User::THUMB_SIDEBAR])) ? $user_login->image_thumbnails[\App\User::THUMB_SIDEBAR] : $user_login->photo))}}">
                        @else
                            <span class="ion-person sidebar-no-picture"></span>
                        @endif
                        <div class="mt">Welcome, {{$user_login->first_name}}</div>
                    </div>
                    <nav class="sidebar-nav">
                        <ul>
                            <li><a class="ripple" href="{{URL::action('AdminController@getIndex')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Home</span></a></li>
                            <li><a class="ripple" href="{{URL::action('AdminController@getContactImporter')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Contact Importer</span></a></li>
                            <li><a class="ripple" href="{{URL::action('BookingsController@getAdminTable')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Bookings</span></a></li>
                            <li><a class="ripple" href="{{URL::action('GroupsController@getAdminTable')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Groups</span></a></li>
                            @if($user_login->roles->first()->slug == "agent")
                                <li><a class="ripple" href="{{URL::action('ClientsController@getClientTable')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Clients</span></a></li>
                            @endif
                            @if (!Sentinel::inRole(\App\Role::ROLE_AGENT))
                                <li><a class="ripple" href="{{URL::action('UsersController@getUsers')}}"><span class="pull-right nav-label"><span class="badge bg-success"></span></span><span class="nav-icon"><img class="hidden" src="" alt="MenuItem"></span><span>Users</span></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="sidebar-layout-obfuscator"></div>
            <!-- Main section-->
            <main class="main-container">
                @yield('content')
                @include('footer.admin')
            </main>
        </div>
        <!-- Search template-->
        <div class="modal modal-top fade modal-search" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="pull-left">
                            <button class="btn btn-flat" type="button" data-dismiss="modal"><em class="ion-arrow-left-c icon-24"></em></button>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-flat" type="button"><em class="ion-android-microphone icon-24"></em></button>
                        </div>
                        <form class="oh" action="#">
                            <div class="mda-form-control pt0">
                                <input class="form-control header-input-search" type="text" placeholder="Search.." data-localize="header.SEARCH">
                                <div class="mda-form-control-line"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search template-->
        <!-- Settings template-->
        <div class="modal-settings modal modal-right fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="pull-right clickable" data-dismiss="modal"><em class="ion-close-round text-soft"></em></div>
                        <h4 class="modal-title"><span>Settings</span></h4>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-default btn-raised" type="button" data-toggle-fullscreen="">Toggle fullscreen</button>
                    </div>
                </div>
            </div>
        </div>

        <!--======= Dynamic Modal =========-->
        <div id="dynamic_modal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="dynamic_modal_title"></h4>
              </div>
              <span id="dynamic_modal_body"><span>
              
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Settings template-->
        <!-- Google Maps API-->
        <!--
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBNs42Rt_CyxAqdbIBK0a5Ut83QiauESPA"></script>
        -->
        <!-- build:js(../app) js/vendor.js-->
        <!-- Modernizr-->
        <script src="{{asset('js/modernizr.custom.js?'.Config::get('app.cache_buster'))}}"></script>

        <!-- jQuery Browser-->
        <script src="{{asset('js/jquery.browser.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Material Colors-->
        <script src="{{asset('js/colors.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Bootstrap Filestyle-->
        <script src="{{asset('js/bootstrap-filestyle.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Flot charts-->
        <script src="{{asset('js/jquery.flot.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.categories.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.spline.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.tooltip.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.resize.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.pie.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.time.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.flot.orderBars.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jVector Maps-->
        <script src="{{asset('js/jquery-jvectormap-1.2.2.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery-jvectormap-us-mill-en.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery-jvectormap-world-mill-en.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Easypie Charts-->
        <script src="{{asset('js/jquery.easypiechart.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Screenfull-->
        <script src="{{asset('js/screenfull.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Sparkline-->
        <script src="{{asset('js/index.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Datepicker-->
        <script src="{{asset('js/bootstrap-datepicker.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery Knob charts-->
        <script src="{{asset('js/jquery.knob.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Rickshaw-->
        <script src="{{asset('js/d3.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/rickshaw.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery Form Validation-->
        <script src="{{asset('js/jquery.validate.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/additional-methods.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- JQUERY STEPS-->
        <script src="{{asset('js/jquery.steps.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Select2-->
        <script src="{{asset('js/select2.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Clockpicker-->
        <script src="{{asset('js/bootstrap-clockpicker.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Range Slider-->
        <script src="{{asset('js/nouislider.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- ColorPicker-->
        <script src="{{asset('js/bootstrap-colorpicker.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Summernote-->
        <script src="{{asset('js/summernote.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Dropzone-->
        <script src="{{asset('js/dropzone.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Xeditable-->
        <script src="{{asset('js/bootstrap-editable.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Momentjs-->
        <script src="{{asset('js/moment-with-locales.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Google Maps-->
        <script src="{{asset('js/gmaps.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Bootgrid-->
        <script src="{{asset('js/jquery.bootgrid.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.bootgrid.fa.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Datatables-->
        <script src="{{asset('js/vendor/datatables.net/js/jquery.dataTables.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-buttons/js/dataTables.buttons.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-buttons/js/buttons.flash.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-buttons/js/buttons.html5.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-buttons/js/buttons.print.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-responsive/js/dataTables.responsive.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/datatables.net-scroller/js/dataTables.scroller.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/switchery/dist/switchery.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/jszip/dist/jszip.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/pdfmake/build/pdfmake.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/pdfmake/build/vfs_fonts.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/vendor/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js?'.Config::get('app.cache_buster'))}}"></script>

        <!-- Nestable-->
        <script src="{{asset('js/jquery.nestable.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Sweet Alert-->
        <script src="{{asset('js/sweetalert-dev.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Masonry-->
        <script src="{{asset('js/masonry.pkgd.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Images Loaded-->
        <script src="{{asset('js/imagesloaded.pkgd.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- Loaders.CSS-->
        <script src="{{asset('js/loaders.css.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- jQuery Localize
        <script src="{{asset('js/jquery.localize.js?'.Config::get('app.cache_buster'))}}"></script>
        -->
        <!-- Blueimp Gallery-->
        <script src="{{asset('js/blueimp-helper.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery-fullscreen.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery-indicator.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery-video.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery-vimeo.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/blueimp-gallery-youtube.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/jquery.blueimp-gallery.js?'.Config::get('app.cache_buster'))}}"></script>

        <!-- Datamaps-->
        <script src="{{asset('js/topojson.min.js?'.Config::get('app.cache_buster'))}}"></script>
        <script src="{{asset('js/datamaps.all.js?'.Config::get('app.cache_buster'))}}"></script>
        <!-- endbuild-->
        <!-- App script-->
        <script src="{{asset('js/app_admin.js?'.Config::get('app.cache_buster'))}}"></script>

         <!--Noty-->
        <script src="{{asset('js/vendor/needim/noty/lib/noty.js?'.Config::get('app.cache_buster'))}}"></script>

        <script src="{{asset('js/views/globals.js?'.Config::get('app.cache_buster'))}}"></script> 
        <script>
            var viewsGlobalInstance = new ViewsGlobals();
            viewsGlobalInstance.displayMessages({!! json_encode(Session::get('messages')) !!});
        </script>

        <script src="{{asset('js/views/layouts/admin.js?'.Config::get('app.cache_buster'))}}"></script> 
        <script>
            var viewsAdminInstance = new ViewsLayoutsAdmin();
        </script>
        @yield('extra_script')
    </body>
</html>