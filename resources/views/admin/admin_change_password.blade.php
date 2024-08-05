@extends('admin.admin_master')
@section('content')	  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <div class="container-full">

		<!-- Main content -->
<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Admin Change Password</h4>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">


					<form method="post" action="{{ route('admin.password.update') }}">
						@csrf
					  <div class="row">
						<div class="col-12">
                            
                            <div class="row">
                                <div class="col-6">

                                    <div class="form-group">
								<h5>Password Lama<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="oldpassword" id="current_password" class="form-control" value="" required=""> </div>
						            </div>


                            <div class="form-group">
								<h5>Password Baru<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password" id="password" class="form-control" value="" required=""> </div>
						    </div>


                                <div class="form-group">
								<h5>Konfirmasi Password Baru<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" required=""> </div>
                                </div>


					
                            
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Update">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
<script type="text/javascript">

	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>
@endsection