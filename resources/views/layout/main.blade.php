<!DOCTYPE html>
<html lang="zh-Hans">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($title) ? $title . ' - ' . $site['sitename'] : $site['sitename'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.css">
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    @yield('header')
</head>
<body class="container">
<header>
    <div id="logo">
        <a href="{{ route('index') }}">{{ $site['sitename'] }}</a>
    </div>
    <a href="#" id="nav-toggle"><i class="fa fa-bars"></i></a>
    <div id="nav">
        <nav>
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('archive') }}">Archive</a></li>
                <li><a href="{{ route('page', 'about') }}">About</a></li>
                @if (\Illuminate\Support\Facades\Auth::check())
                    @if (\Illuminate\Support\Facades\Auth::user() -> role > 2)
                    <li><a href="{{ url('admin') }}">Admin</a></li>
                    @endif
                @endif
            </ul>
        </nav>
        <div id="search">
            <form action="{{ route('search') }}" method="get">
                <input id="s" name="s" type="text" placeholder="Search" autocomplete="off">
            </form>
        </div>
    </div>
</header>
<div class="content">
	@yield('content')
</div>
<footer id="footer">
    <p>
        Copyright © 2008-2015 / Powered by
        <a href="http://www.laravel.com/">Laravel</a> / Developed by
        <a href="http://www.ficush.com/">Ficush</a>
    </p>
    <nav>
        <ul>
            <li><a href="{{ route('page', 'about') }}">About</a></li>
            <li><a href="{{ route('link') }}">Link</a></li>
            @if (\Illuminate\Support\Facades\Auth::check())
            <li><a href="{{ url('auth/logout') }}">Logout</a></li>
            @else
            <li><a href="{{ url('auth/login') }}">Login</a></li>
            @endif
            <li><a href="{{ route('rss') }}">RSS</a></li>
            <li><a href="{{ route('index') }}">Home</a></li>
        </ul>
    </nav>
</footer>
<!-- Scripts -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('script')
<script>
    $(document).ready(function(){
        $("#nav-toggle").click(function(){
            $("#nav").slideToggle(200);
        });
    });
    $(function()
    {
        startTextToolbar();
    });
    function startTextToolbar()
    {
        $('#redactor').redactor({
            imageUpload: '/ajax/redactor/core/uploadImage/',
            fileUpload: '/ajax/redactor/core/uploadFile/',
            plugins: ['table', 'video', 'alignment'],
            minHeight: 300 // pixels
        });
    }
    $('div.alert-success').not('.alert-important').delay(4000).slideUp(500);
</script>
</body>
</html>
