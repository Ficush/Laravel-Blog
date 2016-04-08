@extends('layout.main')

@section('content')
@include('layout.alert')
@foreach($articles as $article)
<article class="entry">
	<div class="entry-header">
		<h2 class="entry-title">
			<a href="{{ route('view.show', [$article -> id]) }}">
				{{ $article -> title }}
			</a>
		</h2>
		<div class="entry-meta">
            <span class="entry-time">
                <time>{{ $article -> created_at -> format('Y-m-d') }}</time>
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
		{{ $article -> content }}
	</div>
	<a class="control"  href="{{ route('view.show', [$article -> id]) }}">阅读全文</a>
</article>
@endforeach
{!! str_replace('/?', '?', $articles -> render()) !!}
@endsection