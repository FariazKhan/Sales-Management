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
            <h3 class="box-title">Create a discount:</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{route('discount.store')}}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title of the discount:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter the title of the discount">
                            <p class="text-danger">{{$errors->first('title')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount of the discount:</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter the discount amount">
                            <p class="text-danger">{{$errors->first('amount')}}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="datepicker">Date when the discount will expire:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="expire_date">

                            </div>
                            <p class="text-danger">{{$errors->first('expire_date')}}</p>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label for="product_id">Date when the discount will expire:</label>
                            <select name="product_id" id="product_id" class="custom-select form-control" >
                                <option value="" disabled selected>-- Select a product --</option>
                                @foreach($data as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }} ({{ $value->available }} available)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="text-danger font-play">{{ $errors->first('same_name') }}</p>
                        <p class="text-danger font-play">{{ $errors->first('invalid_date') }}</p>
                        <p class="text-danger font-play">{{ $errors->first('same_id') }}</p>
                        <p class="text-danger font-play">{{ $errors->first('invalidpwd') }}</p>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <button type="submit" class="btn btn-success pull-right">Create <i class="fa fa-arrow-right"></i></button>
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
            $('#datepicker').datepicker({
                autoclose: true
            })
        });
    </script>
@endsection

@endsection