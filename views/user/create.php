<h2>Добавление нового пользователя</h2>

<form method="post" action="<?= app()->route->getUrl('/users/store') ?>">
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

    <div style="margin-top: 10px;">
        <label>Роль:</label><br>
        <select name="role">
            <option value="guest">Гость</option>
            <option value="hr">HR-специалист</option>
            <option value="admin">Администратор</option>
        </select>
    </div>

    <div style="margin-top: 15px;">
        <button type="submit">Создать пользователя</button>
        <a href="<?= app()->route->getUrl('/users') ?>">Отмена</a>
    </div>
</form>