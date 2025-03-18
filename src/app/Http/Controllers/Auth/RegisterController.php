<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    /**
     * 登録フォームを表示
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * 新規ユーザー登録
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
            // パスワードをハッシュ化
            $hashedPassword = Hash::make($request->input('password'));

            // ユーザーを保存
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $hashedPassword,
            ]);

            // 登録したユーザーの情報をセッションに保存（オプション）
            session([
                'user_data' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]
            ]);

            // 登録が完了したらログイン画面にリダイレクト
            return redirect()->route('login');
    }

}