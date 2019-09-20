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
                <a href="{{route('users.create')}}">
                    <button class="btn btn-success btn-block font-play"><i class="fa fa-plus"></i> Add An User</button>
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            @if(session('inssuccess'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    User Registered successfuly.
                </div>
            @endif
            @if(session('updtsuccess'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    User Updated successfuly.
                </div>
            @endif
            @if(session('dltsuccess'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-times"></i> Success!</h4>
                    User Deleted successfuly.
                </div>
            @endif
            @if(session('onlyadminacc'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-times"></i> Error!</h4>
                    The only admin account of the system cannot be deleted.
                </div>
            @endif

            <br>

            <br>

            <table id="example1" class="table table-bordered table-striped font-muli">
                <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dat as $data)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$data->name}} @if($data->id == Auth::user()->id) (You) @endif</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->role}}</td>
                        <td>{{$data->created_at}}</td>
                        <td><a href="{{ route('users.edit', $data->id) }}"><i class="fa fa-pencil btn btn-info m-auto"></i></a></td>
                        <td>
                            <form id="deleteForm{{$data->id}}" method="post" action="{{ route('users.destroy', $data->id) }}" style="display: none">
                                @csrf
                                @method('delete')
                            </form>
                            <a onclick="if(confirm('Are you sure you want to delete the user containing name {{$data->name}}?')){event.preventDefault();document.getElementById('deleteForm{{$data->id}}').submit();}else{event.preventDefault();}"><i class="fa fa-trash btn btn-danger m-auto"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered At</th>
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