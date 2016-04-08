<?php namespace App\Http\Controllers\Admin;

use Request, Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\System;


class SystemController extends Controller {
   
    public function index()
    {
        $systems = System::all();
        $title = '系统设置';
        $typeArray = [
            'string' => '字符串',
            'int' => '整数',
            'boolean' => '布尔值',
            'float' => '浮点数',
        ];
        return view('admin.system.index', compact('systems', 'title', 'typeArray'));
    }

    public function create()
    {
        $data = [
            'buttonText' => '新增设置',
            'method' => 'POST',
            'url' => route('admin.system.store'),
            'title' => '新增设置',
        ];
        return view('admin.system.editor', $data);
    }

    public function store()
    {
        $data = Request::only('key', 'value', 'type', 'description');
        if (System::where('key', $data['key']) -> count() > 0)
        {
            Session::flash('warning', '您添加的设置键值已存在');
            return redirect() -> back() -> withInput();
        }
        System::create($data);
        Session::flash('success', '键值「' . $data['key'] . '」成功添加到数据库中');
        return redirect() -> route('admin.system.index');
    }

    public function show()
    {
        return redirect() -> route('/');
    }

    public function edit($id)
    {
        $system = System::find($id);
        if (!$system)
        {
            Session::flash('warning', '您要编辑的设置并不存在');
            return redirect() -> back();
        }
        $data = [
            'system' => $system,
            'buttonText' => '编辑设置',
            'method' => 'PATCH',
            'url' => route('admin.system.update', $id),
            'title' => '编辑设置',
        ];
        return view('admin.system.editor', $data);
    }

    public function update($id)
    {
        $data = Request::only('key', 'value', 'type', 'name', 'description');
        $system = System::find($id);
        if (!$system)
        {
            Session::flash('warning', '您要编辑的设置并不存在');
            return redirect() -> back();
        }
        if (System::where('key', $data['key']) -> count() > 0)
        {
            if ($system -> key != $data['key'])
            {
                Session::flash('warning', '您修改的设置键值已存在');
                return redirect() -> back() -> withInput();
            }
        }
        $system -> update($data);
        Session::flash('success', '该设置的内容已经编辑成功');
        return redirect() -> route('admin.system.index');
    }

    public function destroy($id)
    {
        $system = System::find($id);
        if (!$system)
        {
            Session::flash('warning', '您要删除的设置并不存在');
            return redirect() -> back();
        }
        $systemname = $system -> name;
        $system -> delete();
        Session::flash('success', '设置「' . $systemname . '」已成功从数据库中删除');
        return redirect() -> route('admin.system.index');
    }


}
