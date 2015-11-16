<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'txtUser'=>'required|unique:users,username',
			'txtPass'=>'required',
			'txtRePass'=>'required|same:txtPass',
			'txtEmail'=>'required|email'
		];
	}

	public function messages(){
		return[
			'txtUser.required' => 'Vui lòng nhập Username',
			'txtUser.unique' => 'Username đã tồn tại',
			'txtPass.required' => 'Vui lòng nhập Password',
			'txtRePass.required' => 'Vui lòng nhập lại Password',
			'txtRePass.same' => 'Password không trùng nhau',
			'txtEmail.required' => 'Vui lòng nhập Email',
			'txtEmail.email' => 'Đây không phải là Email'
			//'txtEmail.regex' => 'Đây không phải là Email'
		];
	}

}
