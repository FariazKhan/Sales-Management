@extends('master')

@section('contents')

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		User Registered successfuly.
	</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Register a sale:
			
		</h3>
		<!-- tools box -->
		<div class="pull-right box-tools">
			<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
			title="Collapse">
			<i class="fa fa-minus"></i></button>

		</div>
		<!-- /. tools -->
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		{!! Form::open(['route' => 'users.store']) !!}
			@csrf
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Name:</label>
						<input class="form-control" id="name" type="text" name="name" placeholder="Enter the name of the user">
					</div>
                    <div class="form-group">
						<label for="name">Email:</label>
						<input class="form-control" id="name" type="email" name="email" placeholder="Enter the name of the user">
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" id="name" class="custom-select form-control" >
					    	@foreach($dat as $value)
						    	<option value="{{ $value->role_id }}">{{ $value->role_desc_formal }}</option>
					    	@endforeach
					    </select>
                    </div>

				</div>

                <div class="col-md-6">
                    <div class="form-group">
						<label for="password">Password:</label>
						<input class="form-control" id="name" type="text" name="password" placeholder="Enter the password (Min. 8 characters)">
					</div>

                    <div class="form-group">
						<label for="confpwd">Confirm Password:</label>
						<input class="form-control" id="name" type="password" name="confpwd" placeholder="Confirm password (Min. 8 characters)">
					</div>

                    <div class="form-group">
                        <br>
                        <p class="font-muli">* The profile image can be added in the "Profiles" section. By default, an avatar
                        will be used as the profile image.</p>
                    </div>
                </div>
				
			<div class="col-md-12">
                <p class="text-danger font-play">{{ $errors->first('sameValue') }}</p>
                <p class="text-danger font-play">{{ $errors->first('wrongPwd') }}</p>
                <p class="text-danger font-play">{{ $errors->first('lowPwd') }}</p>
            </div>
			<div class="col-md-12">
			<hr>
				{!! Form::submit('Register >>', ['class' => 'btn btn-success pull-right']) !!}
				<a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
			</div>
			</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection