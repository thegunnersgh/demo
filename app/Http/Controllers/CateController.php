<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\Cate;

class CateController extends Controller {

	public function getAdd(){
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		//print_r($parent);die;
		return view('admin.cate.add', compact('parent'));
	}

	public function postAdd(CateRequest $request){
		
		$cate = new Cate;
		$cate->name = $request->txtCateName;
		$cate->alias = changeTitle($request->txtCateName);
		$cate->order = $request->txtOrder;
		$cate->parent_id = $request->sltParent;
		$cate->keywords = $request->txtKeywords;
		$cate->description = $request->txtDescription;
		$cate->save();
		return redirect()->route('admin.cate.list')->with(['flash_level' => 'success', 'flash_message'=>'Add Success!']);
	}

	public function getList(){
		$data = Cate::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
		return view('admin.cate.list', compact('data'));
	}

	public function getEdit($id){
		$data = Cate::findOrFail($id)->toArray();
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		return view('admin.cate.edit', compact('parent', 'data', 'id'));
	}

	public function postEdit(Request $request, $id){
		$this->validate($request,
			['txtCateName' => 'required'],
			['txtCateName.required' => 'Bạn phải nhập CateName']
		);

		$cate= Cate::find($id);
		$cate->name = $request->txtCateName;
		$cate->alias = changeTitle($request->txtCateName);
		$cate->order = $request->txtOrder;
		$cate->parent_id = $request->sltParent;
		$cate->keywords = $request->txtKeywords;
		$cate->description = $request->txtDescription;
		$cate->save();
		return redirect()->route('admin.cate.list')->with(['flash_level' => 'success', 'flash_message'=>'Add Success!']);
	}

	public function getDelete($id){
		$parent = Cate::where('parent_id', $id)->count();
		if($parent == 0){
			$del = Cate::find($id)->delete();
			return redirect()->route('admin.cate.list')->with(['flash_level' => 'success', 'flash_message'=>'Delete Success!']);
		}
		else{
			echo "<script type='text/javascript'>
					alert('Xin lỗi! Bạn không thể xóa Category này.');
					window.location = '";
					echo route('admin.cate.list');
			echo "'</script>";
		}
	}
}
