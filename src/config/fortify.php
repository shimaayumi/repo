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
];
