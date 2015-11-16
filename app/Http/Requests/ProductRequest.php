<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'txtName' => 'required|unique:products,name',
			'fImages' => 'required|image',
			'sltParent' => 'required'
		];
	}

	public function messages(){
		return [
			'txtName.required' => 'Vui lòng nhập tên Product',
			'txtName.unique' => 'Tên Product đã tồn tại',
			'fImages.required' => 'Vui lòng chọn Image',
			'fImages.image' => 'Đây không phải là Image',
			'sltParent.required' => 'Vui lòng chọn Category'
		];
	}

}
