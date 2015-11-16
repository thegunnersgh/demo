<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model {

	protected $table= 'cates';

	protected $fillable = ['name', 'alias', 'order', 'parent_id', 'keywords', 'description'];

	//public $timestamps = false;
	//neu ko co time trong csdl thi bat timestamps, co thi ko bat hoac de false
	//neu co times trong csdl ma bat timestamps = false thi time = 0
	public function product(){
		return $this->hasMany('App\Product');
		//mot cate thi co nhieu san pham
	}

}
