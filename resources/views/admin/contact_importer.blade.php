@extends('layouts.admin')
@section('content')
    <!-- Page content-->
    <section>
        <div class="content-heading bg-white">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="m0 text-thin">Dashboard</h4><small>Contact Importer</small>
                </div>
                <div class="col-sm-4 text-right hidden-xs">
                    <button class="mt-sm btn btn-labeled btn-default ripple" type="button">Edit<span class="btn-label btn-label-right"><i class="ion-plus-round"></i></span></button>
                    <button class="mt-sm btn btn-labeled btn-default ripple" type="button">Delete<span class="btn-label btn-label-right"><i class="ion-plus-round"></i></span></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
              <div class="card-heading">Basic Table</div>
              <!-- START table-responsive-->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- END table-responsive-->
            </div>
        </div>
    </section>
@endsection