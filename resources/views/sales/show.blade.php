@extends('master')

@section('customStyles')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section('contents')
<div class="box">
	<div class="box-header row">
		<div class="col-md-5 pull-left">
			<h3 class="box-title font-play">View The Products:</h3>
		</div>
		<div class="col-md-2 pull-right">
			<button href="{{ route('sales.create') }}" class="btn btn-success btn-block font-play"><i class="fa fa-plus"></i> Add A Sale</button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">

		@if(session('inssuccess'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				Sales Registered successfuly.
			</div>
		@endif
		@if(session('dltsuccess'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				Sales Deleted successfuly.
			</div>
		@endif
		
		<br>
		@if($role != 'super_admin')
			<p>To edit or delete sales, please contact the administrator</p>
		@endif
		<br>

		<table id="example1" class="table table-bordered table-striped font-muli">
			<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Sold At</th>
					@if($role == 'super_admin')
						<th>Edit</th>
						<th>Delete</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($dat as $data)
				<tr>
					<td>{{$loop->index + 1}}</td>
					<td>{{$data->name}}</td>
					<td>{{$data->quantity}}</td>
					<td>{{$data->created_at}}</td>
					@if($role == 'super_admin')
						<td><a href="{{ route('sales.edit', $data->id) }}"><i class="fa fa-pencil btn btn-info m-auto"></i></a></td>
					<td>
						<form id="deleteForm{{$data->id}}" method="post" action="{{ route('sales.destroy', $data->id) }}" style="display: none">
							@csrf
							@method('delete')
						</form>
						<a onclick="if(confirm('Are you sure you want to delete the sale containing name {{$data->name}}?')){event.preventDefault();document.getElementById('deleteForm{{$data->id}}').submit();}else{event.preventDefault();}"><i class="fa fa-trash btn btn-danger m-auto"></i></a>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Sl. No.</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Sold At</th>
					@if($role == 'super_admin')
						<th>Edit</th>
						<th>Delete</th>
					@endif
				</tr>
			</tfoot>
		</table>
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
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection