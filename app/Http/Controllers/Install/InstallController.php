<?php namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Model\System;
use Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Install\DatabaseController;

class InstallController extends Controller {

    public function index()
    {
        if (Schema::hasTable('System'))
        {
            if (System::getConfig('sitename'))
            {
                Session::flash('warning', '站点已经成功安装，请勿重复安装');
                return redirect() -> route('index');
            }
        }
        return view('install.index');
    }
    
    public function install()
    {
        if (Schema::hasTable('System'))
        {
            if (System::getConfig('sitename'))
            {
                Session::flash('warning', '站点已经成功安装，请勿重复安装');
                return redirect() -> route('index');
            }
        }
        DatabaseController::install(Request::all());
    }



}
