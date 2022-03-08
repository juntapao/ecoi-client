{{--!<nav class="navbar navbar-inverse navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="home">{{config('app.name', 'LSAPP')}}</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="nav navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/lsapp/public/homes">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lsapp/public/about">About <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/lsapp/public/services">Services <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="/lsapp/public/post">Blog <span class="sr-only"></span></a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="post/create">Create Post</a></li>
        </ul>
        </div>
    </div>
</nav>
--}}
<nav class="navbar navbar-inverse fix">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            @if (Auth::guest())
                
            @else
                {{-- <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link" type="button" id="menu1" data-toggle="dropdown">Transaction <span class="sr-only"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/transactions/coi_a">COI A</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/transactions/coi_ao">COI AO</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/transactions/coi_b">COI B</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/transactions/coi_d">COI D</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/transactions/coi_r">COI R</a></li>
                            
                            <!--<li role="presentation" class="divider"></li>-->
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" type="button" id="menu2" data-toggle="dropdown">Maintenance <span class="sr-only"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/branch">Branch</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/roles">Role</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/users">User</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/mlhuillier/public/setting">System Setting</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" type="button" id="menu3" data-toggle="dropdown">Reports <span class="sr-only"></span></a>
                    </li>
                </ul> --}}
                @foreach (session('parentmenu') as $parentmenus)
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="dropdown-toggle" role="button" id="menu2" data-toggle="dropdown">{{$parentmenus->label}} <span class="sr-only"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                @foreach (session('childmenu') as $childmenus)
                                    @if ($parentmenus->id == $childmenus->parent)
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{$childmenus->link}}">{{$childmenus->label}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                @endforeach
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                        <a role="menuitem" tabindex="-1" href="/mlhuillier/public/registered">Registered</a>
                    </li>
                </ul>
               

            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    {{-- <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li> --}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->full_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/mlhuillier/public/dashboard">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>