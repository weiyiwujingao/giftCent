<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCardTypeStoreRequest extends FormRequest
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
            'gr_ids'     => 'required',
            'name'       => 'required|between:2,20',
            'price'      => 'required',
            'company_id' => 'required:integer',
            'start_time' => 'required',
            'end_time'   => 'required',
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'gr_ids.required'     => '表单信息不合法',
            'name.required'       => '套餐名不能为空',
            'name.between'        => '套餐名长度应该在2~20位之间',
            'price.required'      => '价格不能为空',
            'company_id.required' => '请选择所属公司',
            'start_time.required' => '有效期开始时间不能为空',
            'end_time.required'   => '有效期结束时间不能为空',
        ];
    }
}
