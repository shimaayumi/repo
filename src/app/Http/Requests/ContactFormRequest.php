<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証が不要な場合はtrue
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2,3',
            'email' => 'required|email|max:255',
            'tel' => 'required|regex:/^[0-9]{10,11}$/', // 電話番号
            'address' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'detail' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'tel.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.regex' => '電話番号は半角数字でハイフンなしで入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}