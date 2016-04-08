@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li class="active">系统设置</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">系统设置</div>
        <div class="panel-body">
            <a class="button" href="{{ route('admin.system.create') }}">
                <i class="fa fa-plus"></i> 新建设置
            </a>
        @if (!empty($systems))
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>键</th>
                        <th>值</th>
                        <th>类型</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($systems as $system)
                    <tr>
                        <td>{{ $system -> id }}</td>
                        <td>{{ $system -> key }}</td>
                        <td>{{ $system -> value }}</td>
                        <td>{{ $typeArray[$system -> type] }}</td>
                        <td>{{ $system -> description }}</td>
                        <td>
                            <a href="{{ route('admin.system.edit', $system -> id) }}" title="编辑"><i class="fa fa-edit"></i></a> |
                            <form action="{{ route('admin.system.destroy', $system -> id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="button-inline" title="删除"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>合计设置数：{{ count($systems) }}</p>
        @endif
        </div>
    </div>
@endsection
