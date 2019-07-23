<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddExpressRequest extends FormRequest
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
			'order_sn'   => 'required|exists:gift_order,order_sn|unique:gift_order_express,order_sn',
		];
    }
    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'order_sn.required'  => '请填写必要的订单号！',
			'order_sn.exists'    => '不存在的订单',
			'order_sn.unique'    => '该订单已添加过物流，无需添加！',
        ];
    }
}
