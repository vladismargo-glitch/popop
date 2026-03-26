<h2>Управление подразделениями</h2>

<?php if (app()->auth::user()->hasRole('admin')): ?>
    <a href="<?= app()->route->getUrl('/departments/create') ?>" style="display: inline-block; margin-bottom: 15px; padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px;">➕ Добавить подразделение</a>
<?php endif; ?>

<?php if ($departments->isEmpty()): ?>
    <div style="background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 4px;">
        Нет данных о подразделениях
    </div>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background: #f2f2f2;">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td><?= $department->id ?></td>
                <td><?= htmlspecialchars($department->name) ?></td>
                <td>
                    <?php
                    $types = [
                        'teaching' => 'Преподавательский',
                        'support' => 'Учебно-вспомогательный',
                        'administrative' => 'Административно-хозяйственный'
                    ];
                    echo $types[$department->type] ?? $department->type;
                    ?>
                </td>
                <td>
                    <?php if (app()->auth::user()->hasRole('admin')): ?>
                        <form action="<?= app()->route->getUrl('/departments/destroy') ?>" method="post" style="display: inline;">
                            <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                            <input type="hidden" name="id" value="<?= $department->id ?>">
                            <button type="submit" onclick="return confirm('Удалить подразделение?')" style="background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Удалить</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div style="margin-top: 15px;">
    <a href="<?= app()->route->getUrl('/') ?>">← На главную</a>
</div>