<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

	protected $table= 'product_images';
	//1234567
	//nhanh dev
	//nhanh a

	protected $fillable = ['image', 'product_id'];

	public $timestamps = false;

	public function product(){
		return $this->belongTo('App\Product');
		//mot image chi co 1 san pham
	}

}
