@extends('user.main_master')

@section('content')

    <div class="body-content vh-100 mt-5" >
        <div class="container" >
                <h2 class="text-center">
                Change Password
                </h2>
            <div class="row mt-4">

                <div class="col-md-2 col-sm-12 px-0">
                <div
                  id="sidebar"
                  class="collapse collapse-horizontal show border-end me-3"
                >
                  <div
                    id="sidebar-nav"
                    class="list-group border-0 rounded-0 text-sm-start me-3"
                  >

                    <a
                      href="{{ route('dashboard') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Dashboard</a
                    >
                    <a
                      href="{{ route('user.profile.edit') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Profile Update</a
                    >
                    <a
                      href="{{ route('change.password') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Change Password</a
                    >
                    <a
                      href="{{ route('user.logout') }}"
                      class="btn btn-danger fw-bold btn-sm btn-block my-3"
                      >Logout</a
                    >
                  </div>
                </div>
              </div>

                <div class="col-md-6 ">
                    <form method="POST" class="card-body cardbody-color p-lg-5" action="{{ route('user.update.password') }}">
            @csrf
    

                <div class="form-group mb-4">
				<label for="oldpassword" class="form-label fw-bold">Password Lama<span class="text-danger">*</span></label>
				<div class="my-2">
				<input type="password" name="oldpassword" id="current_password" class="form-control" value="" required=""> </div>
				</div>

                <div class="form-group mb-4">
					<label for="password" class="form-label fw-bold">Password Baru<span class="text-danger">*</span></label >
					<div class="my-2">
					<input type="password" name="password" id="password" class="form-control" value="" required=""> </div>
				</div>
                <div class="form-group">
					<label for="password" class="form-label fw-bold">Konfirmasi Password Baru<span class="text-danger">*</span></label >
					<div class="controls">
					<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" required=""> </div>
                </div>               

                <div class="text-center mt-4"><button type="submit" class="btn btn-dark px-5 mb-5 fw-bold">Update</button></div>
              </form>
                </div>
            </div>
        </div>
    </div>

@endsection