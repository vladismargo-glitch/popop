<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<h1>Проверка валидаторов</h1>';

// Подключаем автозагрузку
require_once __DIR__ . '/../vendor/autoload.php';

// Проверяем классы
echo 'RequireValidator: ' . (class_exists(\Validators\RequireValidator::class) ? '✅ Есть' : '❌ НЕТ') . '<br>';
echo 'UniqueValidator: ' . (class_exists(\Validators\UniqueValidator::class) ? '✅ Есть' : '❌ НЕТ') . '<br>';
echo 'Src\Validator\Validator: ' . (class_exists(\Src\Validator\Validator::class) ? '✅ Есть' : '❌ НЕТ') . '<br>';
echo 'Src\Validator\AbstractValidator: ' . (class_exists(\Src\Validator\AbstractValidator::class) ? '✅ Есть' : '❌ НЕТ') . '<br>';

// Проверяем папки
echo '<h2>Проверка файлов</h2>';
echo 'app/Validators/RequireValidator.php: ' . (file_exists(__DIR__ . '/../app/Validators/RequireValidator.php') ? '✅' : '❌') . '<br>';
echo 'app/Validators/UniqueValidator.php: ' . (file_exists(__DIR__ . '/../app/Validators/UniqueValidator.php') ? '✅' : '❌') . '<br>';
echo 'core/Src/Validator/Validator.php: ' . (file_exists(__DIR__ . '/../core/Src/Validator/Validator.php') ? '✅' : '❌') . '<br>';
echo 'core/Src/Validator/AbstractValidator.php: ' . (file_exists(__DIR__ . '/../core/Src/Validator/AbstractValidator.php') ? '✅' : '❌') . '<br>';