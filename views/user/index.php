<h2>Управление пользователями</h2>

<a href="<?= app()->route->getUrl('/users/create') ?>" class="btn btn-success">➕ Добавить пользователя</a>

<?php if (isset($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
<?php endif; ?>

<table class="table">
    <thead>
    <th>ID</th>
    <th>Имя</th>
    <th>Логин</th>
    <th>Роль</th>
    <th>Назначить роль</th>
    <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= htmlspecialchars($user->name) ?></td>
            <td><?= htmlspecialchars($user->login) ?></td>
            <td>
                <?php
                $roles = [
                    'admin' => 'Администратор',
                    'hr' => 'HR-специалист',
                    'guest' => 'Гость'
                ];
                echo $roles[$user->role] ?? $user->role;
                ?>
            </td>
            <td>
                <?php if ($user->login !== 'admin' && $user->role !== 'hr'): ?>
                    <form action="<?= app()->route->getUrl('/users/set-role') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <input type="hidden" name="role" value="hr">
                        <button type="submit" class="btn btn-info btn-sm">Назначить HR</button>
                    </form>
                <?php elseif ($user->role === 'hr' && $user->login !== 'admin'): ?>
                    <form action="<?= app()->route->getUrl('/users/set-role') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <input type="hidden" name="role" value="guest">
                        <button type="submit" class="btn btn-warning btn-sm">Снять HR</button>
                    </form>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($user->login !== 'admin'): ?>
                    <form action="<?= app()->route->getUrl('/users/destroy') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить пользователя?')">🗑️</button>
                    </form>
                <?php else: ?>
                    <span class="text-muted">Нельзя удалить</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div style="margin-top: 15px;">
    <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">На главную</a>
</div>