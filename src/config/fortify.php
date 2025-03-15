<?php

return [
    'guard' => 'web',

    'prefix' => 'auth',

    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'features' => [
        'registration' => true,
        'resetPasswords' => true,
        'emailVerification' => true,
        'updateProfileInformation' => true,
        'updatePasswords' => true,
        'twoFactorAuthentication' => true,
    ],
    'redirects' => [
        'login' => '/admin',  // ログイン後に遷移する場所
        'register' => '/login',  // 登録後にログイン画面に遷移
    ],
 
];
