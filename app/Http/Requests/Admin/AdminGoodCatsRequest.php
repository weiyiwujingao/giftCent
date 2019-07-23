<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminGoodCatsRequest extends FormRequest
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
			'name'      => 'required|between:1,20',
//			'parent_id' => 'required:integer',
			'status' => 'required:integer',
		];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => '分类名不能为空',
            'name.between'      => '分类名长度应该在1~20位之间',
//            'parent_id.required'=> '参数有误',
//            'parent_id.integer' => '参数类型有误',
			'status.required'=> '分类状态有误',
			'status.integer' => '分类状态类型有误',
        ];
    }
}
