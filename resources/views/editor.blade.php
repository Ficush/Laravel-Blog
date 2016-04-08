@extends('layout.main')

@section('header')
<link rel="stylesheet" href="{{ asset('editor/redactor.min.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        @if (isset($article))
        <li><a href="{{ route('view.show', [$article -> id]) }}">{{ $article -> title }}</a></li>
        @endif
        <li class="active">{{ $buttonText }}</li>
    </ol>
@include('layout.alert')
	<div>
		{!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form-horizontal']) !!}
		<div class="form-group">
            {!! Form::label('title', '标题', ['class' => 'form-label']) !!}
            {!! Form::text('title', isset($article) ? $article -> title : '', ['class' => 'form-control', 'placeholder' => '标题']) !!}
		</div>
		<div class="form-group">
            {!! Form::label('slug', '网址（如非页面无需填写）', ['class' => 'form-label']) !!}
            {!! Form::text('slug', isset($article) ? $article -> slug : '', ['class' => 'form-control']) !!}
		</div>
        <div class="form-group">
            {!! Form::label('category', '分类', ['class' => 'form-label']) !!}
            {!! Form::select('category', $cate, isset($article) ? $article -> cat_id : 0, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::textarea('content', isset($article) ? $article -> content : '', ['id' => 'redactor', 'rows' => 20]) !!}
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
            <span>
                {!! Form::checkbox('status', $value = 1, $checked = isset($article) ? $article -> status : 1, $options = ['class' => 'form-control']) !!} 公开发表
                @if (\Auth::check())
                    @if (\Auth::user() -> role >= 2)
                {!! Form::checkbox('is_page', $value = 1, $checked = isset($article) ? $article -> is_page : 0, $options = ['class' => 'form-control']) !!} 是否页面
                    @endif
                @endif
            </span>
		</div>
		{!! Form::close() !!}
        @foreach ($errors -> all() as $error)
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-warning"></i> {{ $error }}
        </div>
        @endforeach
</div>
@endsection

@section('script')
<script src="{{ asset('editor/redactor.min.js') }}"></script>
@endsection