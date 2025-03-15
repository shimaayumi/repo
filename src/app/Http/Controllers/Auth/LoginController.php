<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // ユーザー認証を試みる
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->remember)) {
            // ログイン成功後のリダイレクト
            return redirect()->intended(route('admin'));  // 管理画面にリダイレクト
        }

        // ログイン失敗した場合
        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードが間違っています'],
        ]);
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