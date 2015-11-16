<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table= 'products';

	protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'user_id', 'cate_id'];

	//public $timestamps = false;

	public function cate(){
		return $this->belongTo('App\Cate');
		//mot san pham chi co 1 cate
	}

	public function user(){
		return $this->belongTo('App\User');
		//mot san pham chi do 1 user dang
	}

	public function pimages(){
		return $this->hasMany('App\ProductImage');
		//mot san pham co nhieu image
	}

}
