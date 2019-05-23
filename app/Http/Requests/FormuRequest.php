<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormuRequest extends FormRequest
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
            'username' => 'required|regex:/^\w{6,12}$/',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
        ];
    }




     public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.regex' => '用户名格式不正确',
            'username.unique' => '用户名已经存在',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ];
    }
}
