@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li class="active">后台管理</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">欢迎进入后台管理界面，请选择您要进行的操作：</div>
        <div class="panel-body">
            <p>>> <a href="{{ route('admin.system.index') }}">系统设置</a> | 配置博客的全局设置，添加与修改自定义设置</p>
            <p>>> <a href="{{ route('admin.user.index') }}">用户管理</a> | 管理博客注册用户的权限与状态</p>
            <p>>> <a href="{{ route('admin.article.index') }}">文章管理</a> | 管理博客的所有文章，修改文章状态信息</p>
            <p>>> <a href="{{ route('admin.category.index') }}">分类管理</a> | 管理博客的文章分类，自定义新的分类</p>
            <p>>> <a href="{{ route('admin.link.index') }}">友链管理</a> | 管理博客的友情链接，自定义友情链接排序</p>
            <div class="alert alert-info">
                您的登录信息为：管理员 {{ \Auth::user() -> name }} | 登录时间 {{ \Carbon\Carbon::now() }}
            </div>
        </div>
    </div>
@endsection
