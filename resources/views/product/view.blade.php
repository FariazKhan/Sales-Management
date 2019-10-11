@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center font-muli">Product Details</h1>
            <div class="card">
                <div class="card-header text-center"></div>

                <div class="card-body">
                    <div class="details m-auto">
                        <table id="example1" class="table table-bordered table-striped">
                            <tr>
                                <td><strong>Name: </strong></td>
                                <td>{{ $dat->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Unit Purchased: </strong></td>
                                <td>{{ $dat->quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Price Per Unit: </strong></td>
                                <td>{{ $dat->price }}</td>
                            </tr>
                            <tr>
                                <td><strong>Currently Available: </strong></td>
                                <td>{{ $dat->available }}</td>
                            </tr>
                            <tr>
                                <td><strong>Purchased At: </strong></td>
                                <td>{{ $dat->created_at }} ( {{Carbon::make($dat->created_at)->diffForHumans()}} )</td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="col-md-3 m-auto">
                                <button class="btn btn-block btn-success" id="printbtn" onclick="printPage()"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @section('customScript')
        <script>
            function printPage() {
                document.getElementById('printbtn').style.display = 'none';
                window.print();
            }
        </script>
    @endsection
@endsection
