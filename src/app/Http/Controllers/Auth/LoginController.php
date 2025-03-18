<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * ログインフォームを表示
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // リクエストからemailとpasswordを取得
        $credentials = $request->only('email', 'password');

        // ユーザー認証を試みる
        if (Auth::attempt($credentials, $request->remember)) {
            // ログイン成功後のリダイレクト
            return redirect()->intended(route('admin'));  // 管理画面にリダイレクト
        }

        // ログイン失敗した場合のカスタムエラーメッセージ
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ])->withInput(); // エラーメッセージをセッションにフラッシュして、入力内容を保持
    }

    /**
     * ログアウト処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();  // ログアウト処理

        return redirect()->route('login');  // ログイン画面へリダイレクト
    }
}