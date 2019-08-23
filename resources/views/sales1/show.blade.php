@extends('admin/master')

@section('customStyles')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection

@if(session('insertion'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Posted successfuly.
	</div>
@endif
@if(session('success'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Post Deleted successfuly.
	</div>
@endif
@if(session('edtSuccess'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		Post Edited successfuly.
	</div>
@endif

@section('contents')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">View The Posts:</h3>
		<a href="{{ route('post.create') }}" class="btn btn-success"><i class="fa fa-plus"> Add Post</i></a>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Title</th>
					<th>Slug</th>
					<th>Posted At</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($dat as $data)
				<tr>
					<td>{{$loop->index + 1}}</td>
					<td>{{$data->title}}</td>
					<td>{{$data->slug}}</td>
					<td>{{$data->created_at}}</td>
					<td><a href="{{ route('post.edit', $data->id) }}"><i class="fa fa-pencil btn btn-info m-auto"></i></a></td>
					<td>
						<form id="deleteForm{{$data->id}}" method="post" action="{{ route('post.destroy', $data->id) }}" style="display: none">
							@csrf
							@method('delete')
						</form>
						<a onclick="if(confirm('Are you sure you want to delete post containing title {{$data->title}}')){event.preventDefault();document.getElementById('deleteForm{{$data->id}}').submit();}else{event.preventDefault();}"><i class="fa fa-trash btn btn-danger m-auto"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Sl. No.</th>
					<th>Title</th>
					<th>Slug</th>
					<th>Posted At</th>
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