<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    protected $table = 'Links';
    protected $fillable = ['name', 'url', 'order'];

    public static function showLinks()
    {
        return Link::where('id', '>', 0)
            -> orderBy('order', 'desc')
            -> orderBy('id', 'asc')
            -> get();
    }
    
}
