<?php

namespace App\Http\Requests\Api\Gift;

use Illuminate\Foundation\Http\FormRequest;

class GoodsRequest extends FormRequest
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
			'id' => 'required|integer|exists:gift_group_goods,id',
		];
	}

	public function messages()
	{
		return [
			'id.required' => '套餐不能为空！',
			'id.integer' => '非法参数！',
			'id.exists' => '不存在该套餐！',

		];
	}
}
