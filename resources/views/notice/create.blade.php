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
		<h3 class="box-title">Announce a notice:</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<form action="{{route('notice.store')}}" method="POST">
			@csrf
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Name of the notice:</label>
						<input type="text" name="title" id="name" class="form-control" placeholder="Enter the title of the notice">
						<p class="text-danger">{{$errors->first('title')}}</p>
					</div>
					<div class="form-group">
						<label for="name">Body of the notice:</label>
						<input type="text" name="body" id="body" class="form-control" placeholder="Enter the body of the notice">
						<p class="text-danger">{{$errors->first('body')}}</p>
					</div>
				</div>

				<div class="col-md-6">
                    <div class="form-group">
                        <label for="datepicker">Date when notice will expire:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="expdate">

                        </div>
                        <p class="text-danger">{{$errors->first('expdate')}}</p>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <p>*The notice will expire at 12:00 am in the selected date.</p>
                    </div>
				</div>

			<div class="col-md-12">
				<hr>
				<button type="submit" class="btn btn-success pull-right">Publish <i class="fa fa-arrow-right"></i></button>
				<a href="{{ route('notice.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
			</div>
			</div>

		</form>
	</div>
</div>

@section('customScript')
    <script>
        //Date picker
        $(document).ready(function(){
            $('#datepicker').datepicker({
                autoclose: true
            })
        });
    </script>
@endsection

@endsection