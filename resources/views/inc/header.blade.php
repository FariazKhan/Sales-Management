<header class="main-header">

    <a href="{{URL('cpanel')}}" class="logo">

        <span class="logo-mini"><b>S</b>MS</span>

        <span class="logo-lg"><b>S</b>MS</span>
    </a>

    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
                {{ Carbon::now('Asia/Dhaka', '31-01-2017 | 3:45pm') }}
                {{-- {{ Carbon::createFromFormat('Asia/Dhaka', 'd/m/Y g:ia', '05/21/1975 3:59am') }} --}}
            </a>
        </li>
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                {{-- <span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
            </a>
            <ul class="dropdown-menu">

                <li class="user-header">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                    <p>
                        {{ Auth::user()->name }} - Web Developer
                        <small></small>
                    </p>
                </li>

                

                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                {{ __('Logout') }} class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
    </ul>
</div>
</nav>
</header>