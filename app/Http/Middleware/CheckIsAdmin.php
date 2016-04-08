<?php namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckIsAdmin {

	protected $auth;

	public function __construct(Guard $auth)
	{
		$this -> auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		if ($this -> auth -> guest())
		{
			if ($request -> ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
                Session::flash('warning', '对不起，您暂无访问权限，请登录后再操作');
				return redirect() -> guest('auth/login');
			}
		} else {
            if ($this -> auth -> user() -> role < 2)
            {
                Session::flash('warning', '对不起，您不是系统管理员，无法访问后台');
                return redirect() -> route('index');
            }
        }

		return $next($request);
	}

}
