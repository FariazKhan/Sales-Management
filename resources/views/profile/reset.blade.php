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
				<h4><i class="icon fa fa-exclamation-triangle"></i> Error!</h4>
				Failed updating profile. Please re-check the passwords.
			</div>
		@endif

			<div class="row">
				<div class="col-md-12">
					<form action="{{ route('resetpwd') }}" method="post">
					@csrf
					<div class="box-body">
						<div class="col-md-10">
							<div class="form-group">
								<label for="password">Confirm Old Password *</label>
								<input class="form-control" placeholder="Enter your old password" name="oldpwd" type="password" id="password">
								<p class="text-danger">{{ $errors->first('oldpwd') }}</p>
							</div>
							<div class="form-group">
								<label for="newpassword">Type New Password *</label>
								<input class="form-control" placeholder="Enter new password" name="newpwd" type="password" id="newpassword">
								<p class="text-danger">{{ $errors->first('newpwd') }}</p>
							</div>
							<div class="form-group">
								<label for="confnewpassword">Confirm New Password *</label>
								<input class="form-control" placeholder="Confirm new password" name="confnewpwd" type="password" id="confnewpassword">
								<p class="text-danger">{{ $errors->first('confnewpwd') }}</p>
							</div>
							<small class="font-play">The * marked fields are required. Either change them or leave them filled.</small>
                        <div class="form-group">
                            <p class="text-danger">{{$errors->first('pwderr')}}</p>
					    </div>
                        </div>

						<div class="col-md-12">
							<hr>
							{!! Form::submit('Update >>', ['class' => 'btn btn-info pull-right font-quicksand']) !!}
							<a href="{{ url('/')}}" class="btn btn-success font-quicksand"><i class="fa fa-home"></i> Homepage</a>
						</div>

					</div>
					</form>

					</div>
				</div>
			</div>

	</div>
	<!-- /.box-body -->
</div>

@endsection

