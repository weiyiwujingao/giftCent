<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminGiftRequest extends FormRequest
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
                'id'     => 'required',
            ];
        }else{
			$this->errorType = 0;
            return [
				'id'     => 'required',
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
            'id.required'     => '选中卡类型不能为空',
        ];
    }
}
