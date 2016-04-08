@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li class="active">友链管理</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">友链管理</div>
        <div class="panel-body">
            <a class="button" href="{{ route('admin.link.create') }}">
                <i class="fa fa-plus"></i> 新建友链
            </a>
        @if (!empty($links))
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>链接</th>
                        <th>排序</th>
                        <th>创建日期</th>
                        <th>更改日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>{{ $link -> id }}</td>
                        <td>{{ $link -> name }}</td>
                        <td>{{ $link -> url }}</td>
                        <td>{{ $link -> order }}</td>
                        <td>{{ $link -> created_at -> format('Y-m-d') }}</td>
                        <td>{{ $link -> updated_at -> format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.link.edit', $link -> id) }}" title="编辑"><i class="fa fa-edit"></i></a> |
                            <form action="{{ route('admin.link.destroy', $link -> id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="button-inline" title="删除"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>合计友链数：{{ count($links) }}</p>
        @endif
        </div>
    </div>
@endsection
