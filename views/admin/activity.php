<h2>Статистика активности пользователей</h2>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Пользователь</th>
        <th>Действие</th>
        <th>IP адрес</th>
        <th>Время</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= $log->id ?></td>
            <td><?= htmlspecialchars($log->user_name) ?> (ID: <?= $log->user_id ?>)</td>
            <td>
                <?php if ($log->action == 'login'): ?>
                    <span style="color: green;">Вход</span>
                <?php else: ?>
                    <span style="color: orange;">Выход</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($log->ip_address ?? '-') ?></td>
            <td><?= date('d.m.Y H:i:s', strtotime($log->created_at)) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div style="margin-top: 15px;">
    <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">← На главную</a>
</div>