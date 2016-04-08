@extends('layout.main')

@section('content')
@include('layout.alert')
<div class="panel login-panel">
	<div class="panel-heading">注册帐号 | <small><a href="{{ url('auth/login') }}">登录</a></small></div>
	<div class="panel-body">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form role="form" method="POST" action="{{ url('/auth/register') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label class="control-label">名称</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
				<label class="control-label">邮箱</label>
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>
			<div class="form-group">
				<label class="control-label">密码</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
				<label class="control-label">确认密码</label>
				<input type="password" class="form-control" name="password_confirmation">
			</div>
			<div class="form-group">
					<button type="submit" class="btn btn-primary">
						注册
					</button>
			</div>
		</form>
	</div>
</div>
@endsection
