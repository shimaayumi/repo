<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
public function create()
{
return view('auth.register');
}

public function store(StoreUserRequest $request): RedirectResponse
{
// バリデーション済みデータを取得
$validated = $request->validated();

// ユーザーを作成
$user = User::create([
'name' => $validated['name'],
'email' => $validated['email'],
'password' => Hash::make($validated['password']),
]);

// ユーザーをログインさせる（自動ログインを防ぐ場合はコメントアウト）
Auth::login($user);

// ログインページへリダイレクト
return redirect()->route('login');
}
}