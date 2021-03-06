@extends('master')

@section('contents')

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Sale Registered successfuly.
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
		{!! Form::open(['route' => 'sales.store']) !!}
			@csrf
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
					    {!! Form::label('name', 'Product Name') !!}
					    <br>
					    <select name="name" id="name" class="custom-select form-control" >
					    	@foreach($data as $value)
						    	<option value="{{ $value->name }}">{{ $value->name }} ({{ $value->available }})</option>
					    	@endforeach
								<option disabled>*Out of stock items are not listed here.</option>
					    </select>
						<p class="text-danger">{{$errors->first('name')}}</p>
					</div>
					<div class="form-group">
						{!! Form::label('quantity', 'Sold quantity') !!}
						{!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => "Enter the number of sold products...", 'maxlength' => '11']) !!}
						<p class="text-danger">{{$errors->first('quantity')}}</p>
						<p class="text-danger">{{$errors->first('quantityExceeded')}}</p>
						<p class="text-danger">{{$errors->first('quantityInvalid')}}</p>
						<p class="text-danger">{{$errors->first('oos')}}</p>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="customer_phone">Name of customer</label>
						<input type="text" name="customers_name" class="form-control" id="customer_phone" placeholder="Enter the name of the customer">
						<p class="text-danger">{{$errors->first('customers_name')}}</p>
					</div>
					<div class="form-group">
						<label for="customer_phone">Phone number of customer</label>
						<input type="number" name="customers_phone" class="form-control" id="customer_phone" placeholder="Enter the cellphone number of the customer">
						<p class="text-danger">{{$errors->first('customers_phone')}}</p>
					</div>
					<div class="form-group">
						<label for="customer_phone">Email address of customer</label>
						<input type="email" name="customers_email" class="form-control" id="customer_phone" placeholder="Enter the email address of the customer">
						<p class="text-danger">{{$errors->first('customers_email')}}</p>
					</div>
				</div>
				
			<div class="col-md-12">
			<hr>
				{!! Form::submit('Register >>', ['class' => 'btn btn-success pull-right']) !!}
				<a href="{{ route('product.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
			</div>
			</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection