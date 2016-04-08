@extends('layout.main')

@section('content')
@include('layout.alert')
	<article class="entry">
		<div class="entry-header">
			<h2 class="entry-title">{{ $article -> title }}</h2>
            <div class="entry-meta">
            <span class="entry-time">
                <time>{{ $article -> created_at->format('Y-m-d') }}</time>
            </span> /
            <span class="entry-category">
                <a href="{{ route('category', $article -> cat_id) }}">
                    {{ $cate[$article -> cat_id] or '' }}
                </a>
            </span> /
			<span class="entry-views">
                {{ $article -> views }} 浏览
            </span>
            </div>
		</div>
		<div class="entry-content">
			{!! $article -> content !!}
		</div>
        @if (\Illuminate\Support\Facades\Auth::check())
        @if (\Illuminate\Support\Facades\Auth::user() -> id == $article -> user_id || Auth::user()->role >= 2)
        <ol class="breadcrumb">
            <li>管理面板： <a href="{{ route('view.create') }}">创建文章</a></li>
            <li><a href="{{ route('view.edit', $article -> id) }}">编辑本文</a></li>
            <li><a href="{{ route('admin') }}">进入后台</a></li>
        </ol>
        @endif
        @endif
        <ul class="entry-nav">
            <li class="entry-nav-previous">
            @if (!empty($previous))
                <a href="{{ route('view.show', [$previous[0]]) }}">
                    << {{ $previous[1] }}
                </a>
            @endif
            </li>
            <li class="entry-nav-next">
            @if (!empty($next))
                <a href="{{ route('view.show', [$next[0]]) }}">
                    {{ $next[1] }} >>
                </a>
            @endif
            </li>
        </ul>
	</article>
@endsection
