<h2>Регистрация нового пользователя</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger">
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

<form method="post" action="<?= app()->route->getUrl('/signup') ?>" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label class="form-label">Имя</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Логин</label>
        <input type="text" name="login" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Зарегистрироваться</button>
    <p style="margin-top: 15px;">
        <a href="<?= app()->route->getUrl('/login') ?>">Уже есть аккаунт? Войти</a>
    </p>
</form>