<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Fortify のログイン・登録・パスワードリセット画面を設定
Fortify::loginView(fn() => view('auth.login'));
Fortify::registerView(fn() => view('auth.register'));
Fortify::resetPasswordView(fn() => view('auth.passwords.reset'));

// お問い合わせ関連のルート
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');


Route::get('auth/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('auth/register', [RegisterController::class, 'store'])->name('register.store');; // 登録後にログイン画面に遷移します
Route::post('auth/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

// ログインフォーム表示
Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('auth/login', [LoginController::class, 'store'])->name('login.store');

// ログアウト処理
Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

// 管理者関連のルート
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/search', [AdminController::class, 'search'])->name('search');
    Route::delete('/{user}', [AdminController::class, 'destroy'])->name('delete-user'); // ユーザー削除
    Route::get('/export', [AdminController::class, 'export'])->name('export');
});

Route::delete('/admin/contact/{contact}', [AdminController::class, 'destroyContact'])->name('admin.delete-contact');

// 管理画面のルート
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');


Route::delete('/contact/{contact}', [AdminController::class, 'destroy'])->name('admin.contact.delete');


// 入力画面（編集画面）を表示するルート
Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');

Route::get('contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('contact/{id}', [ContactController::class, 'update'])->name('contact.update');

Route::get('/index', [ContactController::class, 'index'])->name('index');
