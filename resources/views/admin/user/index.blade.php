@extends('layout.main')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">首页</a></li>
        <li><a href="{{ route('admin') }}">后台管理</a></li>
        <li class="active">用户管理</li>
    </ol>
    @include('layout.alert')
    <div class="panel admin-panel">
        <div class="panel-heading">用户管理</div>
        <div class="panel-body">
            <a class="button" href="{{ route('admin.user.create') }}">
                <i class="fa fa-plus"></i> 新建用户
            </a>
        @if (!empty($users))
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>角色</th>
                        <th>状态</th>
                        <th>注册日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user -> id }}</td>
                        <td>{{ $user -> name }}</td>
                        <td>{{ $user -> email }}</td>
                        <td>{{ $roleArray[$user -> role] }}</td>
                        <td>{{ $statusArray[$user -> status] }}</td>
                        <td>{{ $user -> created_at -> format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $user -> id) }}" title="编辑"><i class="fa fa-edit"></i></a> |
                            <form action="{{ route('admin.user.destroy', $user -> id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="button-inline" title="删除"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>合计用户数：{{ count($users) }}</p>
        @endif
        </div>
    </div>
@endsection
