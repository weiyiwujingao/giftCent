<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminGroupStoreRequest extends FormRequest
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
			'gs_ids'     => 'required',
			'name'     => 'required|between:2,20',
			'price' => 'required',
			'status'   => 'required:integer',
		];
    }
    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'ids.required'     => '表单信息不合法',
			'name.required'     => '套餐名不能为空',
			'name.between'      => '套餐名长度应该在2~20位之间',
			'price.required'    => '价格不能为空',
			'status.required'   => '状态不能为空',
			'status.integer'    => '表单不合法',
        ];
    }
}
