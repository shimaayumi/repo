<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証が不要な場合はtrue
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id|integer', // categoriesテーブルのidが存在すること
            'first_name' => 'required|string|max:255', // 姓（255文字以内）
            'last_name' => 'required|string|max:255', // 名（255文字以内）
            'gender' => 'required|in:1,2,3', // 性別は1, 2, 3のいずれか
            'email' => 'required|email|max:255', // メールアドレス（255文字以内）
            'tel1' => 'required|digits_between:1,5', // 必須で5桁の数字
            'tel2' => 'required|digits_between:1,5', // 必須で5桁の数字
            'tel3' => 'required|digits_between:1,5', // 必須で5桁の数字
            'address' => 'required|string|max:255', // 住所（255文字以内）
            'building' => 'nullable|string|max:255', // 建物名（任意で255文字以内）
            
            'detail' => 'required|string|max:120', // お問い合わせ内容（必須）
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',

            
        ];
    }
}