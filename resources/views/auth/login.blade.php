@extends('layout.main')

@section('content')
@include('layout.alert')
<div class="panel login-panel">
	<div class="panel-heading">登录 | <small><a href="{{ url('auth/register') }}">注册帐号</a></small></div>
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
		<form role="form" method="POST" action="{{ url('/auth/login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label class="control-label">E-Mail 地址</label>
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>
			<div class="form-group">
				<label class="control-label">密码</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
				<label>
					<input type="checkbox" name="remember"> 保持登录
				</label>
			</div>
			<div class="form-group">
                <button type="submit" class="btn btn-primary">登录</button>
			</div>
		</form>
	</div>
</div>
@endsection
