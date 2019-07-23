<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminGoodsRequest extends FormRequest
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
            'name'   => 'required|between:3,20',
            'price'  => 'required',
            'cat_id' => 'required:integer',
            'status' => 'required:integer',
            'imgs'   => 'required',
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'   => '用户名不能为空',
            'name.between'    => '用户名长度应该在3~20位之间',
            'price.required'  => '价格不能为空',
            'status.required' => '状态不能为空',
            'status.integer'  => '表单不合法',
            'imgs.required'   => '请上传图片',
        ];
    }
}
