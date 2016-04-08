@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li><a href="{{ route('admin.category.index') }}">分类管理</a></li>
        <li class="active">{{ $buttonText }}</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">分类管理</div>
        <div class="panel-body">
            {!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', '分类名称', ['class' => 'form-label']) !!}
                {!! Form::text('name', isset($category) ? $category -> name : '', ['class' => 'form-control', 'placeholder' => '分类名称']) !!}
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