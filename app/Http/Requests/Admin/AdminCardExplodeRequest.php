<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCardExplodeRequest extends FormRequest
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
		return [
			'id'     => 'required|exists:gift_card_type,id',
		];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'     => '参数错误！',
            'id.exists'     => '不存在的卡类型！',
        ];
    }
}
