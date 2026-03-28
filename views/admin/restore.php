<h2>Восстановление базы данных из бэкапа</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= $type ?? 'danger' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-title">Загрузите SQL файл</div>
    <p>Выберите файл бэкапа (.sql) для восстановления базы данных.</p>
    <p><strong>Внимание!</strong> Восстановление перезапишет текущие данные!</p>

    <form method="post" action="<?= app()->route->getUrl('/admin/restore') ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="form-group">
            <label class="form-label">Файл бэкапа (.sql)</label>
            <input type="file" name="backup_file" class="form-control" accept=".sql" required>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-warning" onclick="return confirm('Восстановление перезапишет все данные! Продолжить?')">⚠️ Восстановить</button>
            <a href="<?= app()->route->getUrl('/admin/backup') ?>" class="btn btn-info">Сначала создать бэкап</a>
            <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div><?php
