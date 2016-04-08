@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li class="active">文章管理</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">文章管理</div>
        <div class="panel-body">
            <a class="button" href="{{ route('view.create') }}">
                <i class="fa fa-plus"></i> 新建文章
            </a>
        @if (!empty($articles))
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>标题</th>
                        <th>页面</th>
                        <th>浏览</th>
                        <th>公开</th>
                        <th>发表日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article -> id }}</td>
                        <td>
                            <a href="{{ route('view.show', $article -> id) }}">
                                {{ $article -> title }}
                            </a>
                        </td>
                        <td>{{ $boolArray[$article -> is_page] }}</td>
                        <td>{{ $article -> views }}</td>
                        <td>{{ $boolArray[$article -> status] }}</td>
                        <td>{{ $article -> created_at -> format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('view.edit', $article -> id) }}" title="编辑"><i class="fa fa-edit"></i></a> |
                            <form action="{{ route('view.destroy', $article -> id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="button-inline" title="删除"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! str_replace('/?', '?', $articles -> render()) !!}
        @endif
        </div>
    </div>
@endsection
