<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Fortify のログイン・登録・パスワードリセット画面を設定
Fortify::loginView(fn() => view('login'));
Fortify::registerView(fn() => view('register'));
Fortify::resetPasswordView(fn() => view('passwords.reset'));

// お問い合わせ関連のルート
Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('/', [ContactController::class, 'store'])->name('store');
Route::get('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/submit', [ContactController::class, 'submit'])->name('submit');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');



Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');; // 登録後にログイン画面に遷移します

Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
// ログインフォーム表示
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// ログイン処理
Route::post('login', [LoginController::class, 'store'])->name('login.store');

// ログアウト処理
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// 管理者関連のルート
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/', [AdminController::class, 'index'])->name('admin');
 
    Route::get('/search', [AdminController::class, 'search'])->name('search');
    Route::delete('/{user}', [AdminController::class, 'destroy'])->name('delete-user'); // ユーザー削除
    Route::get('/export', [AdminController::class, 'export'])->name('export');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])->name('admin.delete-contact');


// 入力画面（編集画面）を表示するルート
Route::get('/', [ContactController::class, 'index'])->name('index');
Route::get('/edit', [ContactController::class, 'edit'])->name('edit');
Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
Route::put('/{id}', [ContactController::class, 'update'])->name('update');


