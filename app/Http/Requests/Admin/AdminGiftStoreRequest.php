<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminGiftStoreRequest extends FormRequest
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
            'start_time' => 'required',
            'end_time'   => 'required',
            'num'        => 'required:integer',
            'id'         => 'required:integer',
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'start_time.required' => '开始时间不能为空',
            'end_time.required'   => '结束时间不能为空',
            'num.required'        => '卡数量不能为空',
            'num.integer'         => '卡数量类型有误',
            'company_id.required' => '公司不能为空',
            'company_id.integer'  => '公司类型有误',
            'id.required'         => '卡类型不能为空',
            'id.integer'          => '非法请求',
        ];
    }
}
