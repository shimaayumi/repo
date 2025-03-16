<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
        return view('auth.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 手動でバリデーションを実行
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ]);

        // ユーザー認証を試みる
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->remember)) {
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