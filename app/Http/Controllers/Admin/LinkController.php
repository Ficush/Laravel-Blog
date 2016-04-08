<?php namespace App\Http\Controllers\Admin;

use Request, Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\Link;


class LinkController extends Controller {
   
    public function index()
    {
        $links = Link::orderBy('order', 'desc') -> get();
        $title = '友链管理';
        return view('admin.link.index', compact('links', 'title'));
    }

    public function create()
    {
        $data = [
            'buttonText' => '新增友链',
            'method' => 'POST',
            'url' => route('admin.link.store'),
            'title' => '新增友链',
        ];
        return view('admin.link.editor', $data);
    }

    public function store()
    {
        $data = Request::only('name', 'url', 'description', 'order');
        if (Link::where('name', $data['name']) -> count() > 0)
        {
            Session::flash('warning', '您添加的友链名称已存在');
            return redirect() -> back() -> withInput();
        }
        Link::create($data);
        Session::flash('success', '友链「' . $data['name'] . '」成功添加到数据库中');
        return redirect() -> route('admin.link.index');
    }

    public function show()
    {
        return redirect() -> route('link');
    }

    public function edit($id)
    {
        $link = Link::find($id);
        if (!$link)
        {
            Session::flash('warning', '您要编辑的友链并不存在');
            return redirect() -> back();
        }
        $data = [
            'link' => $link,
            'buttonText' => '编辑友链',
            'method' => 'PATCH',
            'url' => route('admin.link.update', $id),
            'title' => '编辑友链',
        ];
        return view('admin.link.editor', $data);
    }

    public function update($id)
    {
        $data = Request::only('name', 'url', 'description', 'order');
        $link = Link::find($id);
        if (!$link)
        {
            Session::flash('warning', '您要编辑的友链并不存在');
            return redirect() -> back();
        }
        if (Link::where('name', $data['name']) -> count() > 0)
        {
            if ($link -> name != $data['name'])
            {
                Session::flash('warning', '您修改的友链名称已存在');
                return redirect() -> back() -> withInput();
            }
        }
        $link -> update($data);
        Session::flash('success', '该友链的信息已经编辑成功');
        return redirect() -> route('admin.link.index');
    }

    public function destroy($id)
    {
        $link = Link::find($id);
        if (!$link)
        {
            Session::flash('warning', '您要删除的友链并不存在');
            return redirect() -> back();
        }
        $linkname = $link -> name;
        $link -> delete();
        Session::flash('success', '友链「' . $linkname . '」已成功从数据库中删除');
        return redirect() -> route('admin.link.index');
    }


}
