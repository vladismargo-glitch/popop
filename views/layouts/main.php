<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отдел кадров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= app()->route->getUrl('/') ?>">Отдел кадров</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <?php if (app()->auth::check()): ?>
                    <?php if (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= app()->route->getUrl('/employees') ?>">Сотрудники</a>
                        </li>
                    <?php endif; ?>
                    <?php if (app()->auth::user()->hasRole('admin')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= app()->route->getUrl('/departments') ?>">Подразделения</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (app()->auth::check()): ?>
                    <li class="nav-item">
                        <span class="navbar-text me-3">Привет, <?= app()->auth::user()->name ?> (<?= app()->auth::user()->role ?>)</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <?= $content ?? '' ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>