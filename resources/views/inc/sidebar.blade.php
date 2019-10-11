<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <a href="{{ url('profile') }}">
                    <img src="{{asset('user/uploads/avatar/' . Auth::user()->image)}}" class="img-md img-circle" alt="User Image">
            </a>
                <br>
                <br>

            </div>
            <div class="pull-left info" style="margin-left: 10px;">
                <a href="{{ url('profile') }}">
                    <h5 class="font-muli">{{ Auth::user()->name }}</h5>
                </a>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Sales & Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('sales.index') }}"><i class="fa fa-chevron-right"></i> Sales </a></li>
                    @if($role->id == 1)
                        <li class="active"><a href="{{ route('product.index') }}"><i class="fa fa-chevron-right"></i> Stock </a></li>
                    @endif
                </ul>
            </li>

            @if($role->id == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>User Control</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-chevron-right"></i> Manage Users </a></li>
                </ul>
            </li>

            @endif

            @if($role->id == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span>Notices</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('notice.index') }}"><i class="fa fa-chevron-right"></i> Manage Notices </a></li>
                </ul>
            </li>

            @endif

            @if($role->id == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tags"></i> <span>Discount Control</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('discount.index') }}"><i class="fa fa-chevron-right"></i> Manage Discount </a></li>
                </ul>
            </li>

            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>                  