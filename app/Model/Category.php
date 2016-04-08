<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'Categories';
    protected $fillable = ['name'];

    public function owns()
    {
        return $this -> hasMany('App\Model\Article', 'cat_id', 'id');
    }

}
