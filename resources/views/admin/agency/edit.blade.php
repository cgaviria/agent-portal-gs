@extends('layouts.admin')
@section('content')
    
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Edit {{$agency[0]->name}}</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Left column-->
                <div class="col-sm-12">
                    <form class="card form-validate" id="form-edit-agency" name="form-edit-agency" method="post" action="{{action('AgencyController@saveEdit')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                       <div class="card-body">
                            <input type="hidden" id="agency_id" name="agency_id" value="{{$agency[0]->id}}"/>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Name</label>
                                    <div class="col-sm-10">
                                        <input id="agency_name" name="agency_name" class="form-control" type="text" value="{{$agency[0]->name}}"><span class="help-block">Agency name</span>
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
<script src="{{asset('js/views/admin/agency.js?'.Config::get('app.cache_buster'))}}"></script>
<script>
 var ViewsAdminAgencyInstance = new ViewsAdminAgency('','{{action('AgencyController@saveEdit')}}');
</script>
   
@endsection