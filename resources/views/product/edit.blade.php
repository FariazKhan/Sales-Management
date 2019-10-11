@extends('master')

@section('contents')

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Product Registered successfuly.
	</div>
@endif
@if(session('edtsuccess'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Product Updated successfuly.
	</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit the product:
			
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
		{!! Form::model($data, ['route' => ['product.update', $data->id]]) !!}
			@method('PUT')
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('name', 'Product Name') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Enter the product name here"]) !!}
						<p class="text-danger font-play">{{ $errors->first('name') }}</p>
					</div>
					<div class="form-group">
						{!! Form::label('quantity', 'Product Quanity') !!}
						{!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => "Enter the number of purchased product"]) !!}
						<p class="text-danger font-play">{{ $errors->first('quantity') }}</p>
					</div>
					<div class="form-group">
						{!! Form::label('price', 'Price Of Each Unit') !!}
						{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => "Enter the price of each unit"]) !!}
						<p class="text-danger font-play">{{ $errors->first('price') }}</p>
					</div>
					<div class="form-group">
						{!! Form::label('available', 'Product Quanity') !!}
						{!! Form::text('available', null, ['class' => 'form-control', 'placeholder' => "Enter the number of available products"]) !!}
						<p class="text-danger font-play">{{ $errors->first('available') }}</p>
					</div>
				</div>
				
			<div class="col-md-12">
			<hr>
				{!! Form::submit('Go >>', ['class' => 'btn btn-info pull-right']) !!}
				<a href="{{ route('product.index')}}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back</a>
			</div>
			</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection