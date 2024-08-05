@extends('admin.admin_master')
@section('content')	  
      
      <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
                <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                        <a href="{{ route('admin.profile.edit') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Edit Profile</a>
					  <h3 class="widget-user-username">Admin Name : {{ $adminData->name }}</h3>
					  <h6 class="widget-user-desc">Admin Email : {{ $adminData->email }}</h6>
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" style="width: 150px; height: 150px" src="{{ (!empty($adminData->profile_photo_path)) ? url('upload/admin_img/'.$adminData->profile_photo_path) : url('upload/no_image.jpg') }}" alt="User Avatar">
					</div>

				  </div>
			</div>
		</section>
		<!-- /.content -->
	  </div>

@endsection