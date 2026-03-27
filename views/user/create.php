<h2>Добавление нового пользователя</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/users/store') ?>" class="card">
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

    <div class="form-group">
        <label class="form-label">Роль</label>
        <select name="role" class="form-control">
            <option value="guest">👤 Гость</option>
            <option value="hr">📋 HR-специалист</option>
            <option value="admin">👑 Администратор</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Создать пользователя</button>
    <a href="<?= app()->route->getUrl('/users') ?>" class="btn btn-secondary">Отмена</a>
</form>