<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name', 'Ryans Computers')}} | S.M.S</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content">


        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Rynas Computer Ltd.
                        <small class="pull-right">Date: {{ Carbon::now('asia/dhaka')->toDateString() }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Rynas Computers Ltd.</strong><br>
                        125/555, IDB Tower<br>
                        Agargaon, Dhaka-1216<br>
                        Phone: (804) 123-5432<br>
                        Email: info@rynascomputers.net
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{!! $values[0]['customers_name'] !!} </strong><br>
                        Phone: {!! $values[0]['customers_phone'] !!}<br>
                        Email: {!! $values[0]['customers_email'] !!}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice ID:</b> {!! $values[0]['order_token'] !!}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Price Per Unit</th>
                            <th>Discount</th>
                            <th>Grand Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>{!! $values[0]['name'] !!}</td>
                            <td>{!! $values[0]['price_per_unit'] !!}</td>
                            <td>{!! $values[0]['discount_amount'] !!}</td>
                            <td>{!! $values[0]['price_per_unit'] - $values[0]['discount_amount'] !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="{{ asset('admin/dist/img/credit/visa.png') }}" alt="Visa">
                    <img src="{{ asset('admin/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                    <img src="{{ asset('admin/dist/img/credit/american-express.png') }}" alt="American Express">
                    <img src="{{ asset('admin/dist/img/credit/paypal2.png') }}" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Products once sold are not taken back. Malfunctioned products must be replaced within 7 working days.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead"></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{!! $values[0]['price_per_unit'] !!}</td>
                            </tr>
                            <tr>
                                <th>Tax:</th>
                                <td>---</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{!! $values[0]['discount_amount'] !!}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{!! $values[0]['price_per_unit'] - $values[0]['discount_amount'] !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12 pull-right">
                    <form method="post" action="{{ route('GenerateVoucher') }}">
                        @csrf
                        <button type="button" class="btn btn-default mr-3" onclick="printInvoice()"><i class="fa fa-print"></i> Print
                        </button>
                        <input type="hidden" value="{{ json_encode($values) }}" name="json_val">
                        <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i> Proceed
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->

</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    function printInvoice()
    {
        $('no-print').css('display', 'none');
        window.print();
    }
</script>

</body>
</html>
