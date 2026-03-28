<h2>Статистика активности пользователей</h2>

<div class="activity-header">
    <h3>Последние 100 записей</h3>
    <a href="<?= app()->route->getUrl('/admin/export-logs') ?>" class="btn btn-info">Экспорт всех логов в CSV</a>
</div>

<table class="table">
    <thead>
    <th>ID</th>
    <th>Пользователь</th>
    <th>Действие</th>
    <th>IP адрес</th>
    <th>Время</th>
    </thead>
    <tbody>
    <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= $log->id ?></td>
            <td><?= htmlspecialchars($log->user_name) ?> (ID: <?= $log->user_id ?>)</td>
            <td>
                <?php if ($log->action == 'login'): ?>
                    <span class="action-login">Вход</span>
                <?php else: ?>
                    <span class="action-logout">Выход</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($log->ip_address ?? '-') ?></td>
            <td><?= date('d.m.Y H:i:s', strtotime($log->created_at)) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="back-link">
    <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">← На главную</a>
</div>