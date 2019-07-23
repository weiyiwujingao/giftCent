<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCardTypeRequest extends FormRequest
{
	public function __construct( )
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
        if(request()->method() == 'POST')
        {
            return [
                'ids'     => 'required',
            ];
        }else{
			$this->errorType = 0;
            return [
				'ids'     => 'required',
            ];
        }
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'ids.required'     => '选中套餐不能为空',
        ];
    }
}
