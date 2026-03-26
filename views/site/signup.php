<h2>Регистрация нового пользователя</h2>

<?php if (isset($message)): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
        <?php
        $errors = json_decode($message, true);
        if (is_array($errors)) {
            foreach ($errors as $field => $errorMessages) {
                $fieldName = match($field) {
                    'name' => 'Имя',
                    'login' => 'Логин',
                    'password' => 'Пароль',
                    default => $field
                };
                echo '• <strong>' . $fieldName . '</strong>: ' . implode(', ', $errorMessages) . '<br>';
            }
        } else {
            echo htmlspecialchars($message);
        }
        ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/signup') ?>">
    <div style="margin-bottom: 15px;">
        <label>Имя:</label><br>
        <input type="text" name="name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Логин:</label><br>
        <input type="text" name="login" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Пароль:</label><br>
        <input type="password" name="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div>
        <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Зарегистрироваться</button>
        <a href="<?= app()->route->getUrl('/login') ?>">Уже есть аккаунт? Войти</a>
    </div>
</form>