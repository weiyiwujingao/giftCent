<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCompanyRequest extends FormRequest
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
			'name'     => 'required|between:2,20',
			'en_name' => 'required|between:2,20',
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
            'name.required'     => '公司名不能为空',
            'name.between'      => '公司名长度应该在2~20位之间',
            'en_name.required'    => '公司英文名不能为空',
            'en_name.between'    => '公司英文名长度应该在2~20位之间',
            'status.required'   => '状态不能为空',
            'status.integer'    => '表单不合法',
        ];
    }
}
