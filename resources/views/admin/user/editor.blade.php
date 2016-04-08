@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li><a href="{{ route('admin.user.index') }}">用户管理</a></li>
        <li class="active">{{ $buttonText }}</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">用户管理</div>
        <div class="panel-body">
            {!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', '用户名称', ['class' => 'form-label']) !!}
                {!! Form::text('name', isset($user) ? $user -> name : '', ['class' => 'form-control', 'placeholder' => '用户名称']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', '用户状态', ['class' => 'form-label']) !!}
                {!! Form::select('status', [0 => '未激活', 1 => '已激活'], isset($user) ? $user -> status : 1, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role', '用户角色', ['class' => 'form-label']) !!}
                {!! Form::select('role', [
                    0 => '普通用户 | 无发布文章权限',
                    1 => '编辑 | 有发布文章权限，可修改自己的文章',
                    2 => '管理员 | 拥有管理权限，可进入博客后台',
                    3 => '创始人 | 拥有最高权限，无法修改其角色'
                 ], isset($user) ? $user -> role : 0, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
            </div>
            {!! Form::close() !!}
            @foreach ($errors -> all() as $error)
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-warning"></i> {{ $error }}
            </div>
            @endforeach
        </div>
</div>
@endsection