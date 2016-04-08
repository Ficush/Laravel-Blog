@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li><a href="{{ route('admin.link.index') }}">友链管理</a></li>
        <li class="active">{{ $buttonText }}</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">友链管理</div>
        <div class="panel-body">
            {!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', '友链名称', ['class' => 'form-label']) !!}
                {!! Form::text('name', isset($link) ? $link -> name : '', ['class' => 'form-control', 'placeholder' => '友链名称']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url', '友链地址', ['class' => 'form-label']) !!}
                {!! Form::text('url', isset($link) ? $link -> url : '', ['class' => 'form-control', 'placeholder' => '友链地址']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', '友链描述', ['class' => 'form-label']) !!}
                {!! Form::text('description', isset($link) ? $link -> description : '', ['class' => 'form-control', 'placeholder' => '友链描述']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('order', '友链排序（数字越高者排在前面）', ['class' => 'form-label']) !!}
                {!! Form::text('order', isset($link) ? $link -> order : '', ['class' => 'form-control', 'placeholder' => '友链权重']) !!}
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