<?php namespace App\Http\Controllers\Admin;

use Request, Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;


class AdminController extends Controller {
   
    public function index()
    {
        return view('admin.index');
    }

}
