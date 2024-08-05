@extends('user.main_master')

@section('content')

    <div class="body-content vh-100 mt-5">
        <div class="container">
                            <h2 class="text-center">
                Edit Profile
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

                <div class="col-md-6 col-sm-12 ">
                    <form method="POST" class="card-body cardbody-color p-lg-5" action="{{ route('user.profile.update') }}">
            @csrf
    

                <div class="mb-3">
                  <label for="name" class="form-label fw-bold">Nama</label>
                  <input type="text" class="form-control" id="name"
                    placeholder="Masukan Nama" name="name" value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label fw-bold">Email</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Masukan Email" name="email" value="{{ $user->email }}">
                </div>
                {{-- <div class="text-end">
                    <a href="{{ route('password.request') }}" class="text-dark">Forgot Password?</a>
                </div> --}}

                <div class="text-center"><button type="submit" class="btn btn-dark px-5 mb-5 fw-bold">Update</button></div>
              </form>
                </div>
            </div>
        </div>
    </div>

@endsection