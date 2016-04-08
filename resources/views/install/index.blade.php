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
    <div class="panel login-panel">
        <div class="panel-heading">站点安装</div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="POST" action="{{ route('install') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label">站点名称</label>
                    <input type="text" class="form-control" name="sitename" placeholder="站点名称">
                </div>
        </div>
    </div>
    <div class="panel login-panel">
        <div class="panel-heading">用户注册</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="control-label">名称</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label class="control-label">邮箱</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label class="control-label">密码</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label class="control-label">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    创建站点
                </button>
            </div>
            </form>
        </div>
    </div>
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
