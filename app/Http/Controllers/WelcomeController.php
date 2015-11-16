<?php namespace App\Http\Controllers;
use DB, Mail, Request, Cart;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$product= DB::table('products')->select('id', 'name', 'price', 'image', 'alias')->orderBy('id', 'DESC')->skip(0)->take(4)->get();
		return view('user/pages/home', compact('product'));
	}

	public function loaisanpham($id){
		$product_cate = DB::table('products')->select('id', 'name', 'price', 'image', 'alias', 'cate_id')->where('cate_id', $id)->paginate(2);
		$product_new = DB::table('products')->select('id', 'name', 'price', 'image', 'alias', 'cate_id')->orderBy('id', 'DESC')->skip(0)->take(4)->get();
		$parent_id = DB::table('cates')->where('id', $id)->select('parent_id')->first();
		//print_r($parent_id->parent_id);die;
		//print_r($cate_id->cate_id);die;
		$cate_buy = DB::table('cates')->select('id', 'name', 'alias')->where('parent_id', $parent_id->parent_id)->get();
		return view('user/pages/cate', compact('product_cate', 'product_new', 'cate_buy'));
	}

	public function chitietsanpham($id){
		$pro_img = DB::table('product_images')->where('product_id', $id)->get();
		$products = DB::table('products')->where('id', $id)->first();
		//print_r($products);die;
		$pro_cungloai = DB::table('products')->where('cate_id', $products->cate_id)->where('id', '<>', $id)->take(4)->get();
		return view('user/pages/detail', compact('products', 'pro_img', 'pro_cungloai'));
	}

	public function muahang($id){
		$product_buy = DB::table('products')->where('id', $id)->first();
		Cart::add(array(
				'id' => $id,
				'name' => $product_buy->name,
				'qty' => 1,
				'price' => $product_buy->price,
				'options' => array('img' => $product_buy->image)
			));
		$content = Cart::content();
		return redirect()->route('giohang');
	}

	public function giohang(){
		return view('user.pages.shopping');
	}

	public function xoasanpham($id){
		Cart::remove($id);
		return redirect()->route('giohang');
	}

	public function capnhat(){
		if(Request::ajax()){
			$id = Request::get('id');
			$qty = Request::get('qty');
			Cart::update($id, $qty);
			echo "Oke";
		}
	}
}
