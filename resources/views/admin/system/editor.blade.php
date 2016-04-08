@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li><a href="{{ route('admin.system.index') }}">系统设置</a></li>
        <li class="active">{{ $buttonText }}</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">系统设置</div>
        <div class="panel-body">
            {!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('key', '键（Key）', ['class' => 'form-label']) !!}
                {!! Form::text('key', isset($system) ? $system -> key : '', ['class' => 'form-control', 'placeholder' => '键']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('value', '值（Value）', ['class' => 'form-label']) !!}
                {!! Form::text('value', isset($system) ? $system -> value : '', ['class' => 'form-control', 'placeholder' => '值']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', '描述（Description）', ['class' => 'form-label']) !!}
                {!! Form::text('description', isset($system) ? $system -> description : '', ['class' => 'form-control', 'placeholder' => '描述']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('type', '类型（Type）', ['class' => 'form-label']) !!}
                {!! Form::select('type', [
                    'string' => '字符串（String）',
                    'int' => '整数（Int）',
                    'boolean' => '布尔值（Boolean）',
                    'float' => '浮点数（Float）'
                 ], isset($system) ? $system -> type : 'string', ['class' => 'form-control']) !!}
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