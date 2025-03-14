<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

// Fortify のログイン・登録・パスワードリセット画面を設定
Fortify::loginView(fn() => view('auth.login'));
Fortify::registerView(fn() => view('auth.register'));
Fortify::resetPasswordView(fn() => view('auth.passwords.reset'));

// お問い合わせ関連のルート
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');




// Fortify のログイン処理
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');



Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.delete');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');




Route::prefix('admin')->name('admin.')->group(function () {
    // その他のルート

    // ユーザー削除用のルート
    Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
});
