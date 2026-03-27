<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отдел кадров</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= app()->route->getUrl('/') ?>">Отдел кадров</a>
        <ul class="navbar-nav">
            <?php if (app()->auth::check()): ?>
                <?php if (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin')): ?>
                    <li><a href="<?= app()->route->getUrl('/employees') ?>">Сотрудники</a></li>
                    <li><a href="<?= app()->route->getUrl('/employees/average') ?>">Статистика</a></li>
                    <li><a href="<?= app()->route->getUrl('/departments') ?>">Подразделения</a></li>
                <?php endif; ?>
                <?php if (app()->auth::user()->hasRole('admin')): ?>
                    <li><a href="<?= app()->route->getUrl('/users') ?>">Пользователи</a></li>
                    <li><a href="<?= app()->route->getUrl('/admin/activity') ?>">Активность</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <div class="user-info">
            <?php if (app()->auth::check()): ?>
                <span>Привет, <?= app()->auth::user()->name ?> (<?= app()->auth::user()->role ?>)</span>
                <a href="<?= app()->route->getUrl('/logout') ?>" class="btn btn-secondary">Выход</a>
            <?php else: ?>
                <a href="<?= app()->route->getUrl('/login') ?>" class="btn btn-primary">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>" class="btn btn-success">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container">
    <?= $content ?? '' ?>
</main>
</body>
</html>