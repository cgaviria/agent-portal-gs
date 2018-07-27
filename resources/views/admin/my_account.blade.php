@extends('layouts.admin')
@section('content')
    <script src="{{asset('js/views/admin/my_account.js?'.Config::get('app.cache_buster'))}}"></script>
    <script>
        var ViewsAdminMyAccountInstance = new ViewsAdminMyAccount('{{action('UsersController@postMyAccount')}}');
    </script>
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">My Account</h4>
                    <small>Edit your account details here</small>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">


                <!-- Left column-->
                <div class="col-sm-12">
                    <form class="card form-validate" id="form-my-account" name="form-my-account" method="post" action="{{action('UsersController@postMyAccount')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @if (isset($edit_user) && $edit_user)
                            <input type="hidden" id="user_id_to_edit" name="user_id_to_edit" value="{{$logged_in_user->id}}"/>
                        @endif

                        <div class="card-body">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> @if ($logged_in_user->photo)Change @else Upload @endif Picture</label>
                                    <div class="col-sm-10">
                                        @if ($logged_in_user->photo)
                                            <div>
                                                <img class="my-account-image img-circle" src="{{asset(((!empty($logged_in_user->image_thumbnails[\App\User::THUMB_MY_ACCOUNT])) ? $logged_in_user->image_thumbnails[\App\User::THUMB_MY_ACCOUNT] : $logged_in_user->photo))}}">
                                            </div>
                                        @endif
                                        <input class="form-control" id="photo" name="photo" type="file"><span class="help-block">Your picture. Used throughout the dashboard.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input id="first_name" name="first_name" class="form-control" type="text" value="{{$logged_in_user->first_name}}"><span class="help-block">Your first name.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input id="last_name" name="last_name" class="form-control" type="text" value="{{$logged_in_user->last_name}}"><span class="help-block">Your last name.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" class="form-control" type="text" value="{{$logged_in_user->email}}"><span class="help-block">Your email address.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Change Password</label>
                                    <div class="col-sm-10">
                                        <input id="password" name="password" class="form-control" type="password"><span class="help-block">Enter your new password here, or leave it blank to keep your current password.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input id="password_confirmation" name="password_confirmation" class="form-control" type="password"><span class="help-block">Confirm your password if you enter a new password above.</span>
                                    </div>
                                </div>
                            </fieldset>
                            @if($edit_user)
                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left !important;">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control role" name="role" id="role" onchange = "show_agency(this)">
                                          <option value="">Select</option>
                                          <?php foreach($roles as $role){
                                                
                                                  if($role->id == $logged_in_user->role_id)
                                                     $selected = "selected";
                                                  else
                                                      $selected = "";
                                             ?>
                                            <option value="{{$role->id}}" <?php echo $selected;?>>{{$role->name}}</option>
                                          <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            @if($logged_in_user->agency_id)
                              @php $style = ""; @endphp
                            @else
                                @php $style = "display : none;"; @endphp
                            @endif
                             <fieldset class="agentselect" style= "<?php echo $style;?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left !important;">Agency</label>
                                    <div class="col-sm-10">
                                        <select class="form-control agency_id" name="agency_id">
                                              <option value="">Select agency</option>
                                            @foreach($agencies as $agency)
                                              @if($agency->id == $logged_in_user->agency_id)
                                                   @php  $selected = "selected"; @endphp
                                                  @else
                                                    @php  $selected = ""; @endphp
                                              @endif
                                              <option value="{{$agency->id}}" <?php echo $selected;?>>{{$agency->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            
                            @endif
                            <div class="text-right">
                                <button class="btn btn-labeled btn-primary ripple" type="submit" style="padding: 6px 16px;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
     <script>
        function show_agency(a){
          if(a.value == "2" || a.value == "1"){
            $('.agentselect').css('display','block');
          }
          else{
            $('.agentselect').css('display','none');
          }
        }
      </script>
@endsection