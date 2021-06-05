<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><b>Adm</b></span>
        <span class="logo-lg"><b>Admin Panel</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Expandir / Encolher</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/images/admin/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/images/admin/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>

