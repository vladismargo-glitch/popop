<h2>Регистрация нового пользователя</h2>

<?php if (isset($message)): ?>
    <div style="color: red; margin-bottom: 15px;">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/signup') ?>">
    <div>
        <label>Имя:</label><br>
        <input type="text" name="name" required>
    </div>
    <div style="margin-top: 10px;">
        <label>Логин:</label><br>
        <input type="text" name="login" required>
    </div>
    <div style="margin-top: 10px;">
        <label>Пароль:</label><br>
        <input type="password" name="password" required>
    </div>
    <div style="margin-top: 15px;">
        <button type="submit">Зарегистрироваться</button>
        <a href="<?= app()->route->getUrl('/login') ?>" style="margin-left: 10px;">Уже есть аккаунт? Войти</a>
    </div>
</form>