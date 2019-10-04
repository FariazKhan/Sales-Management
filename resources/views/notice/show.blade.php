@extends('master')

@section('customStyles')
	<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section('contents')
	<div class="box">
		<div class="box-header row">
			<div class="col-md-5 pull-left">
				<h3 class="box-title font-play">View The Notices:</h3>
			</div>
			<a href="{{ route('notice.create') }}" class="col-md-2 pull-right">
				<button class="btn btn-success btn-block font-play"><i class="fa fa-plus"></i> Add A Notice</button>
			</a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">

			@if(session('inssuccess'))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
					Notice Posted successfuly.
				</div>
			@endif
			@if(session('dltsuccess'))
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
					Notice Deleted successfuly.
				</div>
			@endif
			@if(session('edt'))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
					Notice Edited successfuly.
				</div>
			@endif

			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Name</th>
					<th>Announced At</th>
					<th>Will Expire In</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tbody>
				@foreach($dat as $data)
					<tr>
						<td>{{$loop->index + 1}}</td>
						<td>{{$data->title}}</td>
						<td>{{$data->created_at}}</td>
						<td>{{Carbon::parse($data->expdate)->diffForHumans()}}</td>
                        <td><a href="{{ route('viewNotice', $data->id) }}"><i class="fa fa-eye btn btn-info m-auto"></i></a></td>
						<td><a href="{{ route('notice.edit', $data->id) }}"><i class="fa fa-pencil btn btn-warning m-auto"></i></a></td>
						<td>
							<form id="deleteForm{{$data->id}}" method="post" action="{{ route('notice.destroy', $data->id) }}" style="display: none">
								@csrf
								@method('delete')
							</form>
							<a onclick="if(confirm('Are you sure you want to delete the product containing title \'{{$data->title}}\'?')){event.preventDefault();document.getElementById('deleteForm{{$data->id}}').submit();}else{event.preventDefault();}"><i class="fa fa-trash btn btn-danger m-auto"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
				<tfoot>
				<tr>
					<th>Sl. No.</th>
					<th>Name</th>
					<th>Announced At</th>
					<th>Will Expire In</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
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
			$('#example1').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : false,
				'scrollX'	  : true
			})
		})
	</script>

@endsection