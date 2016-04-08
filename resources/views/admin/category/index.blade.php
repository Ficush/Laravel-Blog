@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li class="active">分类管理</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">分类管理</div>
        <div class="panel-body">
            <a class="button" href="{{ route('admin.category.create') }}">
                <i class="fa fa-plus"></i> 新建分类
            </a>
        @if (!empty($categories))
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>文章数量</th>
                        <th>创建日期</th>
                        <th>更改日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category -> id }}</td>
                        <td>
                            <a href="{{ route('category', $category -> id) }}">{{ $category -> name }}</a>
                        </td>
                        <td>{{ $category -> owns -> count() }}</td>
                        <td>{{ $category -> created_at -> format('Y-m-d') }}</td>
                        <td>{{ $category -> updated_at -> format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.category.edit', $category -> id) }}" title="编辑"><i class="fa fa-edit"></i></a> |
                            <form action="{{ route('admin.category.destroy', $category -> id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="button-inline" title="删除"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>合计分类数：{{ count($categories) }}</p>
        @endif
        </div>
    </div>
@endsection
