<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use App\Cate;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use Input, File;
use Request; // để làm việc vs ajax thì phải khai báo Requests ntn.
use Auth;
class ProductController extends Controller {

	public function getAdd(){
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		return view('admin.product.add', compact('parent'));
	}

	public function postAdd(ProductRequest $request){
		//die('111111111111111111111');
		//echo 'aaaaaaaaaaaaaaaaaaaaaa';die;
		$file_name = $request->file('fImages')->getClientOriginalName();
		//print_r($file_name);die;
		$product = new Product;
		$product->name = $request->txtName;
		$product->alias = changeTitle($request->txtName);
		$product->price = $request->txtPrice;
		$product->intro = $request->txtIntro;
		$product->content = $request->txtContent;
		$product->image = $file_name;
		$product->keywords = $request->txtKeywords;
		$product->description = $request->txtDescription;
		$product->user_id = Auth::user()->id;
		$product->cate_id = $request->sltParent;
		//print_r($product);die;
		$request->file('fImages')->move('resources/upload/', $file_name);
		$product->save();
		$product_id = $product->id;

		if(Input::hasFile('fProductDetail')){ //nếu có chọn ảnh
			foreach(Input::file('fProductDetail') as $file){
				$product_image = new ProductImage();
				if(isset($file)){
					$product_image->image = $file->getClientOriginalName();
					$product_image->product_id = $product_id;
					$file->move('resources/upload/detail/', $file->getClientOriginalName());
					$product_image->save();
				}
			}
		}

		return redirect()->route('admin.product.list')->with(['flash_level' => 'success', 'flash_message'=>'Add Success!']);
	}

	public function getList(){
		$product = Product::select('id', 'name', 'price', 'cate_id', 'created_at')->orderBy('id', 'DESC')->get()->toArray();
		return view('admin.product.list', compact('product'));
	}

	public function getDelete($id){
		//lấy tất cả thông tin của table image của sản phẩm có id = $id, 
		//do đã tạo liên kết bảng trong model nên sẽ thực hiện như sau
		$pro_image = Product::find($id)->pimages->toArray();
		foreach($pro_image as $value){
			File::delete('resources/upload/detail/'.$value['image']);
		}
		$product = Product::find($id);
		File::delete('resources/upload/'.$product->image);
		$product->delete();
		return redirect()->route('admin.product.list')->with(['flash_level' => 'success', 'flash_message'=>'Delete Success!']);
	}

	public function getEdit($id){
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		$product = Product::find($id);
		$product_image = Product::find($id)->pimages;
		return view('admin.product.edit', compact('parent', 'product', 'product_image'));
	}

	public function postEdit($id,Request $request){
		$product = Product::find($id);
		$product->name = Request::input('txtName');
		$product->alias = changeTitle(Request::input('txtname'));
		$product->content = Request::input('txtContent');
		$product->price = Request::input('txtPrice');
		$product->keywords = Request::input('txtKeywords');
		$product->intro = Request::input('txtIntro');
		$product->description = Request::input('txtDescription');
		$product->user_id = Auth::user()->id;
		$product->cate_id = Request::input('sltParent');
		$img_current = 'resources/upload/'.Request::input('img_current');

		if(!empty(Request::file('fImages'))){
			$tenimage = Request::file('fImages')->getClientOriginalName();
			$product->image = $tenimage;
			Request::file('fImages')->move('resources/upload/', $tenimage);
			if(File::exists($img_current)){
				File::delete($img_current);
			}
		}

		$product->save();

		if(!empty(Request::file('fProductDetail'))){
			foreach (Request::file('fProductDetail') as $file) {
				$pro_image = new ProductImage();
				if(isset($file)){
					$pro_image->image = $file->getClientOriginalName();
					$pro_image->product_id = $id;
					$file->move('resources/upload/detail/', $file->getClientOriginalName());
					$pro_image->save();
				}
			}
		}

		return redirect()->route('admin.product.list')->with(['flash_level' => 'success', 'flash_message'=>'Update Success!']);
	}

	public function delImg($id){
		if(Request::ajax()){ //nếu có dữ liệu từ ajax gửi đến
			$idHinh = (int)Request::get('idHinh');//id image của table product_image
			$image_detail = ProductImage::find($idHinh);//lấy thông tin về image đó
			if(!empty($image_detail)){
				$img = 'resources/upload/detail/'.$image_detail->image;
				if(File::exists($img)){
					File::delete($img);
				}
				$image_detail->delete();
			}
			return "Oke";
		}
	}
}
