<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


use Illuminate\Support\Facades\Route;

use Laravel\Fortify\Fortify;

Fortify::loginView(fn() => view('auth.login'));
Fortify::registerView(fn() => view('auth.register'));
Fortify::resetPasswordView(fn() => view('auth.passwords.reset'));




Route::get('contact', [ContactController::class, 'create']);
Route::post('contact/store', [ContactController::class, 'store']);

Route::get('contact/confirm', [ContactController::class, 'confirm']); // お問い合わせフォーム確認ページ
Route::post('contact/thanks', [ContactController::class, 'submit']); // サンクスページ
Route::get('contact/thanks', [ContactController::class, 'thanks']); // サンクスページ



// ユーザー登録ページ

Route::get('/register', [AuthController::class, 'create'])->name('register.create');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');


// ログインページ
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');



Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');



