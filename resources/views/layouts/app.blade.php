<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Note and share useful links">
    <meta name="keywords" content="link noter">

    <title>Links Noter</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! asset('css/app.css') !!}" media="all" rel="stylesheet" type="text/css" />

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('css')

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Links Noter
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/links') }}">Links</a></li>
                </ul>
                @if (!Auth::guest() && in_array(Auth::user()->id, [1,2]))
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/categories') }}">My Notes</a></li>
                    </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li>
                            <a id="myNotis" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>{{ Auth::user()->getNotificationCount() }}</span>&nbsp;&nbsp;<i class="fa fa-bullhorn"></i></a>
                            <ul class="dropdown-menu" role="menu" style="max-width: 400px;">
                                @foreach(Auth::user()->notifications as $notification)
                                    <li>
                                        <a href="#">
                                            <b class="title">{{$notification['title']}}</b>
                                            <p class="desc" style="font-size: 11px">{{mb_strimwidth($notification['desc'], 0, 50)}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if (Auth::user()->avatar_path)
                                    <img class="topbar-avatar" src="{{url(Auth::user()->avatar_path)}}" />
                                @endif
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/activities/' . Auth::user()->id) }}"><i class="fa fa-btn fa-align-left"></i>Activities</a></li>
                                <li><a href="{{ url('/update-profile') }}"><i class="fa fa-btn fa-edit"></i>Update Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{!! asset('js/notify.js') !!}"></script>
    <script src="{!! asset('js/notify.min.js') !!}"></script>
    <script src="{!! asset('js/common.js') !!}"></script>

    @yield('scripts')


</body>
</html>
