<h2>Добро пожаловать в систему "Отдел кадров"</h2>

<?php if (app()->auth::check()): ?>
    <div class="card">
        <div class="card-title">Приветствие</div>
        <p>Здравствуйте, <?= app()->auth::user()->name ?>!</p>
        <p>Ваша роль: <?= app()->auth::user()->role ?></p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?= \Model\Employee::count() ?></div>
            <div class="stat-label">Всего сотрудников</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= \Model\Department::count() ?></div>
            <div class="stat-label">Подразделений</div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">Быстрые действия</div>
        <div class="btn-group">
            <?php if (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin')): ?>
                <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-primary">Сотрудники</a>
            <?php endif; ?>

            <?php if (app()->auth::user()->hasRole('admin')): ?>
                <a href="<?= app()->route->getUrl('/departments') ?>" class="btn btn-primary">Подразделения</a>
                <a href="<?= app()->route->getUrl('/users') ?>" class="btn btn-primary">Пользователи</a>
            <?php endif; ?>
        </div>
    </div>

<?php else: ?>
    <div class="card">
        <p>Для работы с системой необходимо <a href="<?= app()->route->getUrl('/login') ?>" class="btn btn-primary">войти</a> или <a href="<?= app()->route->getUrl('/signup') ?>" class="btn btn-success">зарегистрироваться</a>.</p>
    </div>
<?php endif; ?>