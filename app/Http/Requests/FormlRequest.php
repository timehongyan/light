<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormlRequest extends FormRequest
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
            'password' => 'required|regex:/^\S{8,16}$/',
            'code'=> 'required',
        ];
    }


    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.regex' => '用户名格式不正确',
            'username.unique' => '用户名已经存在',
            'password.required'=>'密码不能为空',
            'password.required'=>'验证码不能为空',
            // 'repass.required'=>'确认密码不能为空',
        ];
    }
}
