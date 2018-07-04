@extends('layouts.login')
@section('content')
    <div class="layout-container">
        <div class="page-container">
            <div class="container-full">
                <div class="container container-xs">
                    <form class="card b0 form-validate mt-md-2" id="user-login" action="{{URL::action('AuthController@doLogin')}}" onsubmit="viewsLoginInstance.sendFormLogin(this);" name="loginForm" novalidate="">
                        <div class="card-offset pb0">
                            <div class="card-offset-item text-right"><a class="btn-raised btn btn-info btn-circle btn-lg" href="https://www.shoreexcursionsgroup.com/travel-agents-signup"><em class="ion-person-add"></em></a></div>
                            <div class="card-offset-item text-right hidden">
                                <div class="btn btn-success btn-circle btn-lg"><em class="ion-checkmark-round"></em></div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="card-heading">
                            <img class="mv-lg block-center img-responsive" src="{{asset('images/seg-logo.png')}}">
                            <div class="card-title text-center">Login</div>
                        </div>
                        <div class="card-body">
                            <div class="mda-form-group float-label mda-input-group">
                                <div class="mda-form-control">
                                    <input class="form-control" type="email" name="accountName" required="">
                                    <div class="mda-form-control-line"></div>
                                    <label>Email address</label>
                                </div><span class="mda-input-group-addon"><em class="ion-ios-email-outline icon-lg"></em></span>
                            </div>
                            <div class="mda-form-group float-label mda-input-group">
                                <div class="mda-form-control">
                                    <input class="form-control" type="password" name="accountPassword" required="">
                                    <div class="mda-form-control-line"></div>
                                    <label>Password</label>
                                </div><span class="mda-input-group-addon"><em class="ion-ios-locked-outline icon-lg"></em></span>
                            </div>
                            <div class="checkbox c-checkbox pull-right">
                                <label>
                                  <input type="checkbox" name="keep_login" value="YES"><span class="ion-checkmark-round"></span> Remember me
                                </label>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                    <div class="text-center text-sm"><a class="text-inherit" href="recover.html">Forgot password?</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection