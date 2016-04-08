<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB as DataBase;

class Article extends Model {

	protected $table = 'Articles';
	protected $guarded = [];

    public static function showArticle($pageSize, $field = 'id', $order = 'desc')
    {
        return Article::published()
            -> orderBy($field, $order)
            -> paginate($pageSize);
    }

    public static function showRecentArticle($count = 10)
    {
        return Article::published()
            -> recent()
            -> take($count)
            -> get();
    }

    public static function showPopularArticle($count = 10)
    {
        return Article::published()
            -> orderBy('views', 'desc')
            -> take($count)
            -> get();
    }

    public static function showArticleByUser($user_id, $pageSize)
    {
        $articles = Article::published()
            -> where('user_id', $user_id)
            -> orderBy('id', 'desc')
            -> paginate($pageSize);
        return $articles;
    }

    public static function showArticleByCategory($cat_id, $pageSize)
    {
        $articles = Article::published()
            -> where('cat_id', $cat_id)
            -> orderBy('id', 'desc')
            -> paginate($pageSize);
        return $articles;
    }

    public static function showArticleByField($field, $value, $pageSize)
    {
        $articles = Article::published()
            -> where($field, $value)
            -> orderBy('id', 'desc')
            -> paginate($pageSize);
        if (empty($articles)) abort(404);
        return $articles;
    }

    public static function updateViews($id)
    {
        $article = Article::find($id);
        if (empty($article)) return false;
        $article -> views ++;
        $article -> save();
    }

    public static function showNextArticle($id)
    {
        $article = Article::published()
            -> where('id', '>', $id)
            -> orderBy('id', 'asc')
            -> first();
        if (empty($article)) return null;
        return [$article -> id, $article -> title];
    }

    public static function showPreviousArticle($id)
    {
        $article = Article::published()
            -> where('id', '<', $id)
            -> orderBy('id', 'desc')
            -> first();
        if (empty($article)) return null;
        return [$article -> id, $article -> title];
    }

    public static function scopePublished($query)
    {
        return $query -> where('status', '>', 0)
            -> where('is_page', '=', 0);
    }

    public static function scopeRecent($query)
    {
        return $query -> orderBy('id', 'desc');
    }

    public static function searchArticle($field, $word, $pageSize)
    {
        return Article::published()
            -> where($field, 'like', '%'.$word.'%')
            -> orderBy('id', 'desc')
            -> paginate($pageSize);
    }

    public static function distinctDate($field = 'created_at', $unit = 'month')
    {
        $result = [];
        switch ($unit)
        {
            case 'month': $string = '%Y%m'; break;
            case 'day'  : $string = '%Y%m$d'; break;
            default     : $string = '%Y';
        }
        $query = DataBase::raw("strftime('$string', $field)");
        $array = Article::select($query)
            -> distinct()
            -> orderBy($field, 'desc')
            -> get();
        foreach ($array as $value)
        {
            $result[] = $value["strftime('$string', $field)"];
        }
        return $result;
    }

    public static function showArchive($value, $field = 'created_at', $unit = 'month')
    {
        switch ($unit)
        {
            case 'month': $string = '%Y%m'; break;
            case 'day'  : $string = '%Y%m$d'; break;
            default     : $string = '%Y';
        }
        $raw = "strftime('$string', $field) = '$value'";
        return Article::whereRaw($raw)
            -> select('id', 'title', 'created_at')
            -> get();
    }

	public function user()
    {
        return $this -> belongsTo('App\Model\User', 'user_id', 'id');
    }

    public function category()
    {
        return $this -> belongsTo('App\Model\Category', 'cat_id', 'id');
    }

}
