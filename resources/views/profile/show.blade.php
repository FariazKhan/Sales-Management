@extends('master')

@section('customStyles')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section('contents')
<div class="box">
	<div class="box-header">
		<h3 class="box-title font-muli">Edit your profile:</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">

		@if(session('edtsuccess'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				Profile Updated successfuly.
			</div>
		@endif

		@if(session('edtfailed'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Error!</h4>
				Failed updating profile. Please re-check the passwords.
			</div>
		@endif

			<div class="row">
				<div class="col-md-12">
					<div class="col-md-2">
						{!! Form::model($data, ['route' => ['profile.update', $data->id + 53995], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
						<img class="img-lg img-circle" src="{{ asset('user/uploads/avatar/' . Auth::user()->image) }}" alt="User Image">
						<br>
						<br>
						<label for="image">Upload a new avatar:</label>
						<input type="file" name="image" id="image" class="form-control">
					</div>
					<div class="col-md-7 ml-2">
						@method('PUT')
						<div class="box-body">
							<div class="col-md-10">
								<div class="form-group">
									<label for="name">Name <span class="text-danger">*</span> </label>
									{!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => "Enter your name here"]) !!}
									<p class="text-danger font-play">{{ $errors->first('name') }}</p>
								</div>
								<div class="form-group">
									<label for="email">Email <span class="text-danger">*</span> </label>
									{!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => "Enter your email here"]) !!}
									<p class="text-danger font-play">{{ $errors->first('email') }}</p>
								</div>
								<div class="form-group">
									<label for="password">Confirm Old Password</label>
									<input class="form-control" placeholder="Enter your old password" name="oldpwd" type="password" id="password">
								</div>
								<div class="form-group">
									<label for="newpassword">Type New Password</label>
									<input class="form-control" placeholder="Enter new password" name="newpwd" type="text" id="newpassword">
								</div>
								<div class="form-group">
									<label for="confnewpassword">Confirm New Password</label>
									<input class="form-control" placeholder="Confirm new password" name="confnewpwd" type="text" id="confnewpassword">
								</div>

								<small class="font-play">The * marked fields are required. Either change them or leave them filled.</small>
							</div>

							<div class="col-md-12">
								<hr>
								{!! Form::submit('Update >>', ['class' => 'btn btn-info pull-right font-quicksand']) !!}
								<a href="{{ url('/')}}" class="btn btn-success font-quicksand"><i class="fa fa-home"></i> Homepage</a>
							</div>
						</div>

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		
	</div>
	<!-- /.box-body -->
</div>

@endsection

@section('customScript')
<!-- DataTables -->
{{-- <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> --}}
{{-- 
<script>
	$(document).ready(function($){
		if( $('.avail').html == '0' )
		{
			$('.avail').addClass('bg-warning');
		}
	});
</script> --}}
@endsection