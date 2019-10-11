@extends('master')

@section('contents')

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Notice Updated successfuly.
	</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit the notice:</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body row">
		<form action="{{route('discount.update', $dat->id)}}" method="POST">
			@method('PUT')
			@csrf
			<div class="">
				<div class="col-md-5 col-lg-offset-3">
					<div class="form-group">
						<label for="title">Title of the discount:</label>
						<input type="text" name="title" id="title" value="{{$dat->title}}" class="form-control" placeholder="Enter the title of the discount">
						<input type="hidden" value="{{ $dat->product_id }}" name="product_id">
						<p class="text-danger">{{$errors->first('title')}}</p>
					</div>
					<div class="form-group">
						<label for="amount">Amount of the discount:</label>
						<input type="number" name="amount" id="amount" value="{{$dat->amount}}" class="form-control" placeholder="Enter the discount amount">
						<p class="text-danger">{{$errors->first('amount')}}</p>
					</div>
					<div class="form-group">
						<label for="datepicker">Date when the discount will expire:</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" id="datepicker" value="{{$dat->expire_date}}" name="expire_date">
						</div>
						<p class="text-danger">{{$errors->first('expire_date')}}</p>
						<!-- /.input group -->
					</div>
				</div>
				<div class="col-md-12">
					<p class="text-danger font-play">{{ $errors->first('product_id') }}</p>
					<p class="text-danger font-play">{{ $errors->first('product_id_changed') }}</p>
					<p class="text-danger font-play">{{ $errors->first('same_name') }}</p>
					<p class="text-danger font-play">{{ $errors->first('invalid_date') }}</p>
					<p class="text-danger font-play">{{ $errors->first('same_id') }}</p>
					<p class="text-danger font-play">{{ $errors->first('invalidpwd') }}</p>
					<p class="text-danger font-play">{{ $errors->first('invaliddate') }}</p>
				</div>
				<div class="col-md-12">
					<hr>
					<button type="submit" class="btn btn-success pull-right">Update <i class="fa fa-arrow-right"></i></button>
					<a href="{{ route('discount.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
				</div>
			</div>

		</form>
	</div>
</div>

@section('customScript')
    <script>
        //Date picker
        $(document).ready(function(){
			var date = new Date();
			var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            $('#datepicker').datepicker({
				minDate: today
            })
        });
    </script>
@endsection

@endsection