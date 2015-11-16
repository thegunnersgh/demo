<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash, Auth;
class UserController extends Controller {

	public function getList(){
		$user = User::select('id', 'username', 'level')->orderBy('id', 'DESC')->get()->toArray();
		return view('admin.user.list', compact('user'));
	}

	public function getAdd(){
		//die('111111111111111111111');
		return view('admin.user.add');
	}

	public function postAdd(UserRequest $request){
		$user = new User();
		$user->username = $request->txtUser;
		$user->password = Hash::make($request->txtPass);
		$user->email = $request->txtEmail;
		$user->level = $request->rdoLevel;
		$user->remember_token = $request->_token;
		$user->save();
		return redirect()->route('admin.user.list')->with(['flash_level' => 'success', 'flash_message'=>'Add Success!']);
	}

	public function getEdit($id){
		$user = User::find($id)->toArray();
		/*
			Admin thường ko đc sửa SupperAdmin
			Admin thường ko đc sửa Admin mà ko phải chính mình
		*/
		if((Auth::user()->id != 2) && ($id == 2 || ($user['level'] == 1 && Auth::user()->id != $id))){
			return redirect()->route('admin.user.list')->with(['flash_level' => 'danger', 'flash_message'=>'Sorry! Bạn không được phép sửa']);
		}
		return view('admin.user.edit', compact('user'));
	}

	public function postEdit($id, Request $request){
		$user = User::find($id);
		if($request->input('txtPass')){
			$this->validate($request,
			[
				'txtPass'   => 'required',
				'txtRePass' => 'required|same:txtPass' 
			],
			[
				'txtPass.required'   => 'Password không được để trống',
				'txtRePass.required' => 'Nhập thêm một lần Password',
				'txtRePass.same'     => 'Password nhập lại không đúng'
			]);
			$user->password = Hash::make($request->input('txtPass'));
		}
		//$user->username = $request->txtUser;
		$user->level = $request->rdoLevel;
		$user->email = $request->txtEmail;
		$user->remember_token = $request->input('_token');
		$user->save();
		return redirect()->route('admin.user.list')->with(['flash_level' => 'success', 'flash_message'=>'Update Success!']);
	}

	public function getDelete($id){
		/*
		---Nếu đang đăng nhập là SupperAdmin => $user_current_login = 2
			+ Xóa chính nó => $id = 2. Thỏa mãn điều kiện đầu tiên => ko xóa đc
			+ Xóa Admin thường: ví dụ $id = 3
				if( (3 != 2) || ( 2 != 2 && 1 == 1) )=> ko thỏa mãn => chạy else => xóa đc
		---Nếu đăng nhập là Admin thường => $user_current_login != 2;
			+ Xóa SupperAdmin: có $id = 2; thỏa mãn cả 2 đk của if => ko xóa đc
			+ Xóa Admin thường khác và chính nó: 
				thỏa mãn đk là admin của if => ko xóa đc

		*/
		$user_current_login = Auth::user()->id;
		$user = User::find($id);
		if(($id == 2) || ($user_current_login!=2 && $user['level'] == 1)){
			return redirect()->route('admin.user.list')->with(['flash_level' => 'danger', 'flash_message'=>'Sorry Delete!']);
		}
		else{
			$user->delete($id);
			return redirect()->route('admin.user.list')->with(['flash_level' => 'success', 'flash_message'=>'Delete Success!']);
		}
	}

}
