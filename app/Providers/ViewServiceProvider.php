<?php namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Model\Category;
use App\Model\System;
use Illuminate\Support\Facades\Schema;

class ViewServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        if (Schema::hasTable('System')) {
            $site = System::lists('value', 'key');
        } else {
			$site = [];
        }
        if (Schema::hasTable('Categories')) {
            $cate = Category::lists('name', 'id');
        } else {
            $cate = [];
        }
		$cate[0] = '未分类';
		if (!isset($site['sitename']))
		{
			$site['sitename'] = 'New Site';
		}
		// Share data among views
		view() -> share('cate', $cate);
		view() -> share('site', $site);
        
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
