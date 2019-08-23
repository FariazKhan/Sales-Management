@include('inc.head')
<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        @include('inc.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('inc.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                {{-- Section For Contents --}}
                @yield('contents')
                {{-- Section For Contents --}}

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('inc.footer')
    </div>
    <!-- ./wrapper -->
    @include('inc.script')

</body>
</html>
