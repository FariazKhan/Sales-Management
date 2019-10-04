<header class="main-header">

    <a href="{{URL('/')}}" class="logo">

        <span class="logo-mini">RCS</span>

        <span class="logo-lg">Rynas Computers</span>
    </a>

    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

        <li class="user">
            <a class="dropdown-toggle" id="time_text"></a>
        </li>
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">{{ $countNotice }}</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">There are {{ $countNotice }} notices from admin</li>
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        @foreach($notices as $notice)
                        <li class="bg-dark">
                            <a href="notices/{{$notice->id}}">
                                <i class="fa fa-bullhorn text-aqua"></i> {{ $notice->title }}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>

            </ul>
        </li>
        <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('user/uploads/avatar/' . Auth::user()->image)}}" class="user-image" alt="User Image">
                <br>
            </a>
            <ul class="dropdown-menu">

                <li class="user-header">
                    <img src="{{asset('user/uploads/avatar/' . Auth::user()->image)}}" class="img-circle" alt="User Image">

                    <p class="text-capitalize">
                        {{ Auth::user()->name }} - {{ $role->role_desc_formal }}
                        <small></small>
                    </p>
                </li>

                

                <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                {{ __('Logout') }} class="btn btn-default btn-flat">Logout</a>
                    </div>
                </li>
            </ul>
        </li>

        
    </ul>
</div>
</nav>
</header>