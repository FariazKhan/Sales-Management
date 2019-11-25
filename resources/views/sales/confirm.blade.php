@extends('master')

@section('customStyles')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section('contents')
<div class="box">
	<div class="box-header row">
		<div class="col-md-5 pull-left">
			<h3 class="box-title font-play">Confirm purchase:</h3>
		</div>
{{--		<a href="{{ route('sales.create') }}" class="col-md-2 pull-right">--}}
{{--			<button class="btn btn-success btn-block font-play"><i class="fa fa-plus"></i> Add A Sale</button>--}}
{{--		</a>--}}
	</div>

	<!-- /.box-header -->
	<div class="box-body">
		<br>
		<table id="example1" class="table table-bordered table-striped font-muli">
			<thead>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price Per Unit</th>
					<th>Discount</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($values as $value)
					<tr>
						<td>{{$value['name']}}</td>
						<td>{{$value['quantity']}}</td>
						<td>{{$value['price_per_unit']}}</td>
						<td>{{$value['discount_amount']}}</td>
						<td>{{($value['price_per_unit'] - $value['discount_amount']) * $value['quantity'] }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price Per Unit</th>
					<th>Discount</th>
					<th>Total</th>
				</tr>
			</tfoot>
		</table>
        <div class="col-md-12">
            <hr>
            <a href="{{route('sales.index')}}" class="pull-left">
                <button class="btn btn-warning font-play"><i class="fa fa-arrow-left"></i>  Go Back</button>
            </a>
            <form action="{{ route('storeTempData') }}">
                <a href="" class="pull-right">
                    <input type="hidden" name="name" value="<?php gettype($values);  ?>">
                    <input type="hidden" name="quantity" value="<?php  array_column($values, 'quantity') ?>">
                    <input type="hidden" name="price_per_unit" value="<?php array_column($values, 'price_per_unit') ?> ">
                    <input type="hidden" name="discount_amount" value="<?php array_column($values, 'discount_amount') ?> ">
                    <button type="submit" class="btn btn-success font-play">Confirm <i class="fa fa-arrow-right"></i></button>
                </a>
            </form>
        </div>
	</div>
	<!-- /.box-body -->
</div>


@endsection

@section('customScript')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
	  $('#example1').DataTable({
		  'paging'      : true,
		  'lengthChange': false,
		  'searching'   : false,
		  'ordering'    : true,
		  'info'        : true,
		  'autoWidth'   : false,
		  'scrollX'	  : true
	  });
    })
</script>
@endsection