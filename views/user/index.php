<h2>Управление пользователями</h2>

<a href="<?= app()->route->getUrl('/users/create') ?>" style="display: inline-block; margin-bottom: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">➕ Добавить пользователя</a>

<?php if (isset($message)): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
        <?= $message ?>
    </div>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead style="background: #f2f2f2;">
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Логин</th>
        <th>Роль</th>
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
                <?php if ($user->login !== 'admin'): ?>
                    <form action="<?= app()->route->getUrl('/users/destroy') ?>" method="post" style="display: inline;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" onclick="return confirm('Удалить пользователя <?= htmlspecialchars($user->name) ?>?')" style="background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">🗑️ Удалить</button>
                    </form>
                <?php else: ?>
                    <span style="color: gray;">Нельзя удалить</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div style="margin-top: 15px;">
    <a href="<?= app()->route->getUrl('/') ?>">← На главную</a>
</div>