<?php namespace App\Http\Controllers\Admin;

use Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Model\Category;


class CategoryController extends Controller {
   
    public function index()
    {
        $categories = Category::all();
        $title      = '分类管理';
        return view('admin.category.index', compact('categories', 'title'));
    }

    public function create()
    {
        $data = [
            'buttonText' => '新增分类',
            'method' => 'POST',
            'url' => route('admin.category.store'),
            'title' => '新增分类',
        ];
        return view('admin.category.editor', $data);
    }

    public function store()
    {
        $name = Request::input('name');
        if (Category::where('name', $name) -> count() > 0)
        {
            Session::flash('warning', '您添加的分类名称已存在');
            return redirect() -> back() -> withInput();
        }
        Category::create(compact('name'));
        Session::flash('success', '分类「' . $name . '」成功添加到数据库中');
        return redirect() -> route('admin.category.index');
    }

    public function show($id)
    {
        return redirect() -> route('category', $id);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category)
        {
            Session::flash('warning', '您要编辑的分类并不存在');
            return redirect() -> back();
        }
        $data = [
            'category' => $category,
            'buttonText' => '编辑分类',
            'method' => 'PATCH',
            'url' => route('admin.category.update', $id),
            'title' => '编辑分类',
        ];
        return view('admin.category.editor', $data);
    }

    public function update($id)
    {
        $name = Request::input('name');
        $category = Category::find($id);
        if (!$category)
        {
            Session::flash('warning', '您要编辑的分类并不存在');
            return redirect() -> back();
        }
        if ($category -> name == $name) {
            Session::flash('warning', '您并没有对分类信息作出修改');
            return redirect() -> back() -> withInput();
        }
        if (Category::where('name', $name) -> count() > 0)
        {
            Session::flash('warning', '您修改的分类名称已存在');
            return redirect() -> back() -> withInput();
        }
        $category -> update(compact('name'));
        Session::flash('success', '该分类名称已成功编辑为「' . $name . '」');
        return redirect() -> route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category)
        {
            Session::flash('warning', '您要删除的分类并不存在');
            return redirect() -> back();
        }
        $catename = $category -> name;
        $category -> delete();
        $articles = Article::where('cat_id', $id) -> get();
        foreach ($articles as $article)
        {
            $article -> update(['cat_id' => 0]);
        }
        Session::flash('success', '分类「' . $catename . '」已成功从数据库中删除，该分类下的文章更改为未分类');
        return redirect() -> route('admin.category.index');
    }


}
