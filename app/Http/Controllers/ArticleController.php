<?php namespace App\Http\Controllers;

use App\Model\Article;
use DB as DataBase;
use Auth;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Session;

class ArticleController extends BaseController
{

    public function index()
    {
        return redirect('/');
    }

	public function create()
	{
        if (!Auth::Check())
        {
            Session::flash('warning', '您没有权限进行此项操作');
            return redirect() -> back();
        }
        $data = [
            'buttonText' => '发表文章',
            'method' => 'POST',
            'url' => route('view.store'),
            'title' => '发表文章',
        ];
        return view('editor', $data);
	}

    public function store(ArticleRequest $request)
    {
        if (!Auth::Check())
        {
            Session::flash('warning', '您没有权限进行此项操作');
            return redirect() -> back() -> withInput();
        }
        $data = $this -> clean($request);
        $data['user_id'] = Auth::user() -> id;
        $data['user_ip'] = $request -> getClientIp();
        $article = Article::create($data);
        Session::flash('success', '文章已成功发表');
        return redirect()->route('view.show', $article -> id);
    }

    public function show($id)
    {
        $id = $this -> checkIsNumber($id);
        $article = Article::find($id);
        $this -> checkEmpty($article);
        Article::updateViews($id);
        $data =[
            'article'  => $article,
            'next'     => Article::showNextArticle($id),
            'previous' => Article::showPreviousArticle($id),
            'title' => $article -> title,
        ];
        return view('view', $data);
    }

    public function edit($id)
    {
        if (!Auth::Check())
        {
            Session::flash('warning', '您没有权限进行此项操作');
            return redirect() -> back();
        }
        $id = $this -> checkIsNumber($id);
        $article = Article::find($id);
        if (!$article)
        {
            Session::flash('warning', '您要编辑的文章并不存在');
            return redirect() -> back();
        }
        $this -> checkAuth($article -> id);
        $data = [
            'article' => $article,
            'buttonText' => '更新文章',
            'method' => 'PATCH',
            'url' => route('view.update', $id),
            'title' => '更新文章',
        ];
        return view('editor', $data);
    }

    public function update(ArticleRequest $request, $id)
    {
        if (!Auth::Check())
        {
            Session::flash('warning', '您没有权限进行此项操作');
            return redirect() -> back() -> withInput();
        }
        $data = $this -> clean($request);
        $id = $this -> checkIsNumber($id);
        $article = Article::find($id);
        $this -> checkEmpty($article);
        $this -> checkAuth($article -> id);
        $article -> update($data);
        Session::flash('success', '文章已成功编辑');
        return redirect() -> route('view.show', $id);
    }

    public function destroy($id)
    {
        if (!Auth::Check())
        {
            Session::flash('warning', '您没有权限进行此项操作');
            return redirect() -> back();
        }
        $id = $this->checkIsNumber($id);
        $article = Article::find($id);
        $this -> checkEmpty($article);
        if (Auth::user() -> id != $article -> user_id)
        {
            if (Auth::user()->role < 2){
                Session::flash('warning', '您没有权限进行此项操作');
                return redirect() -> back();
            }
        }
        $article -> delete();
        Session::flash('success', '文章已成功删除');
        return redirect() -> route('index');
    }

    private function checkIsNumber($id)
    {
        if (strval(intval($id)) == $id)
        {
            return intval($id);
        }
        Session::flash('warning', '您的信息输入有误');
        return redirect() -> back() -> withInput();
    }

    private function checkEmpty($article)
    {
        if (empty($article)) {
            abort(404);
        } else {
            return null;
        }
    }

    private function checkAuth($user_id)
    {
        if (Auth::user() -> id != $user_id)
        {
            if (Auth::user() -> role < 2){
                Session::flash('warning', '您没有权限进行此项操作');
                return redirect() -> back();
            }
        }
    }

    private function clean($request)
    {
        return [
            'title'   => $request -> input('title'),
            'content' => $request -> input('content'),
            'summary' => str_limit(
                strip_tags($request -> input('content'), 1000)
            ),
            'cat_id'  => $request -> input('category'),
            'status'  => $request -> input('status') ? 1 : 0,
            'is_page'  => $request -> input('is_page') ? 1 : 0,
            'slug' => $request -> input('slug'),
        ];
    }

}
