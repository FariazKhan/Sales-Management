@extends('master')

@section('contents')

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Product Registered successfuly.
	</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Register a product:
			
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
		{!! Form::open(['route' => 'product.store']) !!}
			@csrf
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
					    {!! Form::label('name', 'Product Name') !!}
					    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Enter the product name..."]) !!}
						<p class="text-danger">{{$errors->first('name')}}</p>
					</div>
					<div class="form-group">
						{!! Form::label('quantity', 'Purchase quantity') !!}
						{!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => "Enter the number of purchased products..."]) !!}
						<p class="text-danger">{{$errors->first('quantity')}}</p>
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