<?php namespace App\Http\Controllers\Admin;

use Request, Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\User;


class UserController extends Controller {
   
    public function index()
    {
        $users = User::orderBy('order', 'desc') -> get();
        $title = '用户管理';
        $statusArray = [
            0 => '未激活',
            1 => '已激活',
        ];
        $roleArray   = [
            0 => '普通用户',
            1 => '编辑',
            2 => '管理员',
            3 => '创始人',
        ];
        return view('admin.user.index', compact('users', 'title', 'statusArray', 'roleArray'));
    }

    public function create()
    {
        Session::flash('warning', '无法通过后台新增用户，请使用系统的注册功能');
        return $this -> index();
    }

    public function store()
    {
        Session::flash('warning', '无法通过后台新增用户，请使用系统的注册功能');
        return $this -> index();
    }

    public function show($id)
    {
        return redirect() -> route('user', $id);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user)
        {
            Session::flash('warning', '您要编辑的用户并不存在');
            return redirect() -> back();
        }
        $data = [
            'user' => $user,
            'buttonText' => '编辑用户',
            'method' => 'PATCH',
            'url' => route('admin.user.update', $id),
            'title' => '编辑用户',
        ];
        return view('admin.user.editor', $data);
    }

    public function update($id)
    {
        $data = Request::only('name', 'role', 'status');
        $user = User::find($id);
        if (!$user)
        {
            Session::flash('warning', '您要编辑的用户并不存在');
            return redirect() -> back();
        }
        if (User::where('name', $data['name']) -> count() > 0)
        {
            if ($user -> name != $data['name'])
            {
                Session::flash('warning', '您修改的用户名称已存在');
                return redirect() -> back() -> withInput();
            }
        }
        if ($user -> role != $data['role'])
        {
            if ($user -> role >= 3)
            {
                Session::flash('warning', '您无法修改博客创始人的角色');
                return redirect() -> back() -> withInput();
            }
            if ($data['role'] == 3)
            {
                Session::flash('warning', '您将非博客创始人修改为创始人');
                return redirect() -> back() -> withInput();
            }
            if ($user -> role == 2 && $data['role'] < 2 && Auth::user() -> role < 3)
            {
                Session::flash('warning', '您并非博客创始人，无法将其他管理员降级');
                return redirect() -> back() -> withInput();
            }
            if ($user -> role <= 1 && $data['role'] > 1 && Auth::user() -> role < 3)
            {
                Session::flash('warning', '您并非博客创始人，无法设置管理员');
                return redirect() -> back() -> withInput();
            }
        }
        $user -> update($data);
        Session::flash('success', '该用户的信息已经编辑成功');
        return redirect() -> route('admin.user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user)
        {
            Session::flash('warning', '您要删除的用户并不存在');
            return redirect() -> back();
        }
        if ($user -> role >= 3)
        {
            Session::flash('warning', '您无法删除博客创始人');
            return redirect() -> back();
        }

        if ($user -> role >= 2)
        {
            if (Auth::user() -> role < 3)
            {
                Session::flash('warning', '只有博客创始人才能删除其他管理员帐号');
                return redirect()->back();
            }
        }
        $username = $user -> name;
        $user -> delete();
        Session::flash('success', '用户「' . $username . '」已成功从数据库中删除');
        return redirect() -> route('admin.user.index');
    }


}
