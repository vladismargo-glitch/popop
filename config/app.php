<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'role' => \Middlewares\RoleMiddleware::class,
    ],
    //Класс для валидации
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'email' => \Validators\EmailValidator::class,
        'phone' => \Validators\PhoneValidator::class,
        'date' => \Validators\DateValidator::class,
        'age' => \Validators\AgeValidator::class,
        'length' => \Validators\LengthValidator::class,
        'numeric' => \Validators\NumericValidator::class,
        'range' => \Validators\RangeValidator::class,
    ],
    'routeAppMiddleware' => [
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'csrf' => \Middlewares\CSRFMiddleware::class,
    ]
];