<h1>Добро пожаловать в систему "Отдел кадров"</h1>

<?php if (app()->auth::check()): ?>
    <p>Здравствуйте, <?= app()->auth::user()->name ?>!</p>
    <p>Ваша роль: <?= app()->auth::user()->role ?></p>

    <?php if (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin')): ?>
        <p><a href="<?= app()->route->getUrl('/employees') ?>">📋 Перейти к списку сотрудников</a></p>
    <?php endif; ?>

    <?php if (app()->auth::user()->hasRole('admin')): ?>
        <p><a href="<?= app()->route->getUrl('/departments') ?>">🏢 Управление подразделениями</a></p>
        <p><a href="<?= app()->route->getUrl('/users') ?>">👥 Управление пользователями</a></p>
    <?php endif; ?>

<?php else: ?>
    <p><a href="<?= app()->route->getUrl('/login') ?>">Войти в систему</a></p>
    <p><a href="<?= app()->route->getUrl('/signup') ?>">Зарегистрироваться</a></p>
<?php endif; ?>