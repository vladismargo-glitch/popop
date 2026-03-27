<h2>Управление подразделениями</h2>

<?php if (app()->auth::user()->hasRole('admin')): ?>
    <a href="<?= app()->route->getUrl('/departments/create') ?>" class="btn btn-success">➕ Добавить подразделение</a>
<?php endif; ?>

<?php if ($departments->isEmpty()): ?>
    <div class="alert alert-info">Нет данных о подразделениях</div>
<?php else: ?>
    <table class="table">
        <thead>
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
                        <form action="<?= app()->route->getUrl('/departments/destroy') ?>" method="post" style="display: inline-block;">
                            <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                            <input type="hidden" name="id" value="<?= $department->id ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить подразделение?')">🗑️</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div style="margin-top: 15px;">
    <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">← На главную</a>
</div>