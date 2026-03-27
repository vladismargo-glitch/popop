<h2>Авторизация</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger">
        <?php
        $errors = json_decode($message, true);
        if (is_array($errors)) {
            foreach ($errors as $field => $errorMessages) {
                $fieldName = match($field) {
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

<?php if (!app()->auth::check()): ?>
    <form method="post" action="<?= app()->route->getUrl('/login') ?>" class="card">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="form-group">
            <label class="form-label">Логин</label>
            <input type="text" name="login" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
        <p style="margin-top: 15px;">
            <a href="<?= app()->route->getUrl('/signup') ?>">Нет аккаунта? Зарегистрироваться</a>
        </p>
    </form>
<?php endif; ?>