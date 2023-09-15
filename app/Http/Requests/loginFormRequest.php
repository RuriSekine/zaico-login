<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
     //メールアドレス・パスワード合致しているか確認
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
