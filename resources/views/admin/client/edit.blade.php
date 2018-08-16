@extends('layouts.admin')
@section('content')
    
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="m0 text-thin">Edit Client ID {{$clients[0]->id}}</h4>
                    <small>Edit the client information here</small>
                </div>
                <div class="col-sm-8 text-right hidden-xs upper-right-buttons">
                    <a href="{{ URL::to('/dashboard/clients/view/' . $clients[0]->id) }}" id="btn-all-remove-filter" class="btn btn-primary ripple" type="button" style="padding: 6px 16px;">View Booking</a>
                 </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Left column-->
                <div class="col-sm-12">
                    <form class="card form-validate" id="form-edit-client" name="form-edit-client" method="post" action="{{action('ClientsController@saveEdit')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                       <div class="card-body">
                            <input type="hidden" id="user_id_to_edit" name="user_id_to_edit" value="{{$clients[0]->id}}"/>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input id="first_name" name="first_name" class="form-control" type="text" value="{{$clients[0]->first_name}}"><span class="help-block">First Name of the client.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input id="last_name" name="last_name" class="form-control" type="text" value="{{$clients[0]->last_name}}"><span class="help-block">Last Name of the client.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" class="form-control" type="text" value="{{$clients[0]->email}}"><span class="help-block">Client's email account.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ship</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ship" id="ship" >
                                            @foreach ($ships as $each_ship)
                                              <?php $selected = "";
                                              if($clients[0]->ship_id == $each_ship->id )
                                                    $selected = "selected";
                                              ?>
                                                 <option value="{{ $each_ship->id }}" <?php echo $selected;?>  >{{ $each_ship->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Select the ship this client will be embarking on.</span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Duration</label>
                                    <div class="col-sm-10">
                                       <input class="form-control" name="duration" id="duration" type="text" value="{{$clients[0]->duration}}"><span class="help-block">The duration of the cruise.</span>
                                    </div>
                                </div>
                            </fieldset>
                           
                            <fieldset>
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left !important;">Sail Date</label>
                                <div class="col-sm-10">
                                  <div class="rel-wrapper ui-datepicker ui-datepicker-popup dp-theme-primary" id="sail_date">
                                      <div class="mda-form-control">
                                        <input class="form-control" id="example-datepicker-9" type="text" placeholder="Select a date.." name="sail_date"  value="{{$clients[0]->sail_date}}">
                                        <div class="mda-form-control-line"></div>
                                      </div>
                                    </div>
                                   
                                  
                                  <span class="help-block">Select a sail date for the cruise.</span>
                                </div>
                              </div>
                            </fieldset>
                            <div class="text-right">
                                <button class="btn btn-labeled btn-primary ripple" type="submit" style="padding: 6px 16px;">Submit</button>
                            </div>
                          </div>
                            </form>
                        </div>
                    
                </div>
            </div>
        
    </section>
@endsection
@section('extra_script')
<script src="{{asset('js/views/admin/client.js?'.Config::get('app.cache_buster'))}}"></script>
<script>
  var ViewsAdminClientsInstance = new ViewsAdminClients('','','','{{action('ClientsController@saveEdit')}}');
</script>
   
@endsection