<?php namespace App\Http\Controllers\Install;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use Request;

class DatabaseController extends Controller {
   
	public static function install($data)
	{
        echo '<div style="margin:100px auto;font-size:20px;width:540px;">';

        // Create table 'Articles' and define its structure
        Schema::dropIfExists('Articles');
		Schema::create('Articles', function($table)
		{
			// ID
			$table->increments('id');
            // Content
			$table->string('title');
            $table->string('summary')  ->default('');
			$table->string('content');
            // Category ID
			$table->integer('cat_id')  ->default(0);
            // Metadata
            $table->integer('views')   ->default(0);
            $table->integer('comments')->default(0);
            $table->integer('likes')   ->default(0);
            $table->integer('status')  ->default(1);
            $table->string('user_ip')  ->default('');
            $table->integer('user_id') ->default(1);
            $table->integer('is_page') ->default(0);
            $table->string('slug')     ->default('');
            // Timestamps
            $table->timestamps();
		});
        echo "成功创建数据表 'Articles' <br />";

        // Create table 'Users' and define its structure
        Schema::dropIfExists('Users');
        Schema::create('Users', function($table)
        {
            // ID
            $table->increments('id');
            // Info
            $table->string('name')       ->unique();
            $table->string('password');
            $table->string('email')      ->unique();
            $table->integer('role')      ->default(1);
            $table->string('website')    ->default('');
            // Metadata
            $table->integer('sex')       ->default(1);
            $table->integer('status')    ->default(1);
            $table->string('first_ip')   ->default('');
            $table->string('login_ip')   ->default('');
            // Timestamps
            $table->timestamps();
            $table->rememberToken();
        });
        echo "成功创建数据表 'Users' <br />";

        \App\Model\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 3,
            'first_ip' => Request::getClientIp(),
            'login_ip' => Request::getClientIp(),
        ]);
        echo "成功注册博客创始人<br />";

        // Create table 'Links' and define its structure
        Schema::dropIfExists('Links');
        Schema::create('Links', function($table)
        {
            // ID
            $table->increments('id');
            // Info
            $table->string('name');
            $table->string('url');
            $table->integer('order')     ->default(1);
            $table->string('description')->default('');
            $table->integer('user_id')   ->default(0);
            // Timestamps
            $table->timestamps();
        });
        echo "成功创建数据表 'Links' <br />";

        // Create table 'System' and define its structure
        Schema::dropIfExists('System');
        Schema::create('System', function($table)
        {
            // ID
            $table->increments('id');
            // Info
            $table->string('key')        ->unique();
            $table->string('value')      ->default('');
            $table->string('type')       ->default('string');
            $table->string('description')->default('');
            $table->timestamps();
        });
        echo "成功创建数据表 'System' <br />";

        \App\Model\System::create(['key' => 'sitename', 'value' => $data['sitename']]);
        echo "成功设置站名: " . $data['sitename'] . " <br />";

        // Create table 'Categories' and define its structure
        Schema::dropIfExists('Categories');
        Schema::create('Categories', function($table)
        {
            // ID
            $table->increments('id');
            // Info
            $table->string('name');
            $table->timestamps();
        });
        echo "成功创建数据表 'Categories' <br />";

        echo '<a href="'.route('index').'">安装成功</a><br /></div>';
	}

}
