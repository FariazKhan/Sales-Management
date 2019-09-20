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
		<form method="post" action="{{ route('users.update', $val->id) }}">
			@csrf
			@method('PATCH')
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Name:</label>
						<input class="form-control" id="name" value="{{ $val->name }}" type="text" name="name" placeholder="Enter the name of the user">
					</div>
                    <div class="form-group">
						<label for="name">Email:</label>
						<input class="form-control" id="name" value="{{ $val->email }}"  type="email" name="email" placeholder="Enter the name of the user">
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>

						@if($dat != null)
                        <select name="role" id="name" class="custom-select form-control" >
							<option disabled selected>-- Select a role --</option>
							@foreach($dat as $value)
								<option value="{{ $value->role_id }}">{{ $value->role_desc_formal }}</option>
							@endforeach
					    </select>

						@elseif($dat == null && strcmp($val->role, 1) == 0)
							<p class="text-warning font-play">The system has only 1 admin account. Please add more admin to change role.</p>
						@endif
                    </div>

				</div>

                <div class="col-md-6">
                    <div class="form-group">
						<label for="password">Password:</label>
						<input class="form-control" id="name" type="text" name="password" placeholder="Type a new password (Min. 8 characters)">
					</div>

                    <div class="form-group">
						<label for="confpwd">Confirm Password:</label>
						<input class="form-control" id="name" type="password" name="confpwd" placeholder="Confirm the password">
					</div>

                    <div class="form-group">
                        <br>
                        <p class="font-muli">* The previous profile image will be used. Please visit the the "Profiles" section to edit
							the profile image.</p>
                    </div>
                </div>

			<div class="col-md-12">
                <p class="text-danger font-play">{{ $errors->first('sameValue') }}</p>
                <p class="text-danger font-play">{{ $errors->first('wrongPwd') }}</p>
                <p class="text-danger font-play">{{ $errors->first('lowPwd') }}</p>
                <p class="text-danger font-play">{{ $errors->first('invalidpwd') }}</p>
            </div>
			<div class="col-md-12">
			<hr>
				<button type="submit" class="btn btn-success pull-right">Update <i class="fa fa-arrow-right"></i></button>
				<a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
			</div>
			</div>

		</form>

	</div>
</div>

@endsection