<?php namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Category;
use App\Model\User;
use App\Model\Link;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController {

	public function index()
	{
        $pageSize = 10;
		$articles = Article::showArticle($pageSize);
        $title    = '首页';
		return view('index', compact('articles', 'title'));
	}

    public function home()
    {
        return redirect()->route('index');
    }

    public function user($id)
    {
        $pageSize = 10;
        $articles = Article::showArticleByUser($id, $pageSize);
        $userInfo = User::find($id);
        if (empty($userInfo)){
            abort(404);
        };
        $title    = '用户「' . $userInfo -> name . '」发表的文章';
        Session::flash('info', '用户「' . $userInfo -> name . '」发表的文章');
        return view('index', compact('articles', 'title'));
    }

    public function category($id)
    {
        if ($id == 0) return redirect() -> route('index');
        $pageSize = 10;
        $articles = Article::showArticleByCategory($id, $pageSize);
        $catInfo  = Category::find($id);
        if (empty($catInfo)){
            abort(404);
        }
        $title    = '分类「' . $catInfo -> name . '」下的文章';
        Session::flash('info', '分类「' . $catInfo -> name . '」下的文章');
        return view('index', compact('articles', 'title'));
    }

    public function rss()
    {
        $count = 10;
        $articles = Article::showRecentArticle($count);
        return Response::view('rss', compact('articles'))
            -> header('Content-type','application/rss+xml');
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $word = $request -> input('s');
        if (empty($word)){
            Session::flash('warning', '您输入的搜索关键词为空，请重新输入');
            return redirect() -> back();
        }
        $pageSize = 10;
        $articles = Article::searchArticle('title', $word, $pageSize);
        $title    = '关键词「' . $word . '」的搜索结果';
        Session::flash('info', '关键词「' . $word . '」的搜索结果');
        return view('index', compact('articles', 'title'));
    }

    public function link()
    {
        $linkList = Link::showLinks();
        $title    = '友情链接';
        return view('link', compact('linkList', 'title'));
    }

    public function page($name = null)
    {
        if ($name == null) return redirect() -> route('index');
        $article = Article::where('slug', $name) -> first();
        if (empty($article) || $article -> is_page != 1)
        {
            abort(404);
        }
        Article::updateViews($article -> id);
        $title = $article -> title;
        return view('view', compact('article', 'title'));
    }

    public function archive($field = 'created_at', $unit = 'month')
    {
        $data = array();
        $list = Article::distinctDate($field, $unit);
        foreach ($list as $key => $value)
        {
            $data[$value] = Article::showArchive($value, $field, $unit);
        }
        $title = '归档';
        return view('archive', compact('data', 'title'));
    }
}

