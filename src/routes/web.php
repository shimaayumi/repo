<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;






// Fortify のログイン・登録・パスワードリセット画面を設定
Fortify::loginView(fn() => view('auth.login'));
Fortify::registerView(fn() => view('auth.register'));
Fortify::resetPasswordView(fn() => view('auth.passwords.reset'));

// お問い合わせ関連のルート
Route::get('contact', [ContactController::class, 'create']);
Route::post('contact/store', [ContactController::class, 'store']);
Route::get('contact/confirm', [ContactController::class, 'confirm']); // お問い合わせフォーム確認ページ
Route::post('contact/thanks', [ContactController::class, 'submit']); // サンクスページ
Route::get('contact/thanks', [ContactController::class, 'thanks']); // サンクスページ

// ユーザー登録ページ（Fortifyに統一）
Route::get('/register', fn() => view('auth.register'))->name('register');

// ログインページ（Fortifyに統一）
Route::get('/login', fn() => view('auth.login'))->name('login');

// Fortify のログイン処理
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

// Fortify のログアウト処理
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');



Route::get('/admin', [AdminController::class, 'index']); // 追加：/admin にアクセスしたときに index メソッドを呼び出す




Route::prefix('admin')->name('admin.')->group(function () {
    // その他のルート

    // ユーザー削除用のルート
    Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
});