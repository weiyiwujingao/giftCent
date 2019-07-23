<?php

namespace App\Http\Requests\Api\Gift;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
	public function __construct()
	{
		$this->errorType = 1;
	}
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
			'group_id' => 'required|integer',
			'user_name' => 'required|min:1|max:20|',
			'user_mobile' => 'required|digits:11',
			'user_address' => 'required|min:1|max:20|',
			'user_address_all' => 'required|min:1|max:100|',
		];

	}

	public function messages()
	{
		return [
			'group_id.required' => '套餐不能为空！',
			'group_id.integer' => '套餐选择有误！',
			'user_name.required' => '密码不能为空！',
			'user_name.min' => '收货人不能小于1个字符',
			'user_name.max' => '收货人不能大于20个字符',
			'user_mobile.required' => '手机号不能为空！',
			'user_mobile.digits' => '手机号格式有误！',
			'user_address.min' => '收货人地址不能小于1个字符',
			'user_address.max' => '收货人地址不能大于20个字符',
			'user_address_all.min' => '收货人完整地址不能小于1个字符',
			'user_address_all.max' => '收货人完整地址不能大于100个字符',
		];
	}
}
