<?php

namespace App\Http\Requests\Api\Gift;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
			'card_sn' => 'required|exists:gift_cards,card_sn',
			'card_pass' => 'required|min:6|max:32|',
		];
	}

	public function messages()
	{
		return [
			'card_sn.required' => '卡号不能为空！',
			'card_sn.exists' => '不存在卡号！',
			'card_pass.required' => '密码不能为空！',
			'card_pass.min' => '密码不能小于6个字符',
			'card_pass.max' => '密码不能大于32个字符',
		];
	}
}
