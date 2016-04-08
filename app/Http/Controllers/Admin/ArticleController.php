<?php namespace App\Http\Controllers\Admin;

use Request, Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\Article;


class ArticleController extends Controller {
   
    public function index()
    {
        $pageSize  = 20;
        $articles  = Article::orderBy('order', 'desc') -> paginate($pageSize);
        $title     = '文章管理';
        $boolArray = [0 => '否', 1 => '是'];
        return view('admin.article.index', compact('articles', 'title', 'boolArray'));
    }

    public function create()
    {
        return redirect() -> route('view.create');
    }

    public function show($id)
    {
        return redirect() -> route('view.show', $id);
    }

}
