<h2>Настройки системы</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= $type ?? 'success' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/admin/settings') ?>" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label class="form-label">Название организации</label>
        <input type="text" name="site_name" class="form-control"
               value="<?= htmlspecialchars($settings['site_name'] ?? 'Отдел кадров') ?>" required>
        <small>Отображается в заголовке страницы</small>
    </div>

    <div class="form-group">
        <label class="form-label">Контактный email</label>
        <input type="email" name="site_email" class="form-control"
               value="<?= htmlspecialchars($settings['site_email'] ?? 'hr@company.ru') ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Контактный телефон</label>
        <input type="text" name="site_phone" class="form-control"
               value="<?= htmlspecialchars($settings['site_phone'] ?? '+7 (495) 123-45-67') ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Адрес организации</label>
        <textarea name="site_address" class="form-control" rows="2"><?= htmlspecialchars($settings['site_address'] ?? 'г. Москва, ул. Примерная, д. 1') ?></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Режим обслуживания</label>
        <select name="maintenance_mode" class="form-control">
            <option value="0" <?= ($settings['maintenance_mode'] ?? '0') == '0' ? 'selected' : '' ?>>Обычный режим</option>
            <option value="1" <?= ($settings['maintenance_mode'] ?? '0') == '1' ? 'selected' : '' ?>>Режим обслуживания</option>
        </select>
        <small>В режиме обслуживания доступ к системе получают только администраторы</small>
    </div>

    <div class="btn-group">
        <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        <a href="<?= app()->route->getUrl('/') ?>" class="btn btn-secondary">Отмена</a>
    </div>
</form>

<div class="card" style="margin-top: 20px;">
    <div class="card-title">Информация о системе</div>
    <p><strong>Версия PHP:</strong> <?= phpversion() ?></p>
    <p><strong>Сервер:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Неизвестно' ?></p>
</div>