<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateShopleadersRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
            'shop_name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前を文字列で入力してください',
            'name.max' => '名前を255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.confirmed' => 'パスワードと確認用パスワードが一致しません',
            'password.min' => 'パスワードを8文字以上で入力してください',
            'password_confirmation.required' => '確認用パスワードを入力してください',
            'shop_name.required' => '店舗を選択してください',
        ];
    }
}
