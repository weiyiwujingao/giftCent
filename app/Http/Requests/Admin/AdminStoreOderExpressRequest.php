<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreOderExpressRequest extends FormRequest
{
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
			'ex_id' => 'required|integer|exists:gift_express_info,ex_id',
			'ex_num' => 'required|between:6,30',
			'order_sn' => 'required|exists:gift_order,order_sn|unique:gift_order_express,order_sn',
		];
	}

	/**
	 * 提示信息s
	 * @return array
	 */
	public function messages()
	{
		return [
			'ex_id.required' => '请选中物流公司',
			'ex_id.integer' => '物流公司信息不合法',
			'exists.exists' => '不存在的物流公司',
			'ex_num.required' => '快递单号不能为空',
			'ex_num.between' => '快递单号长度异常',
			'order_sn.required' => '请填写必要的订单号！',
			'order_sn.exists' => '不存在的订单',
			'order_sn.unique' => '该订单已添加过物流，无需添加！',
		];
	}
}
