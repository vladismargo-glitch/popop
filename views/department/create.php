<h2>Добавление нового подразделения</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/departments/store') ?>" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label class="form-label">Название подразделения</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Тип подразделения</label>
        <select name="type" class="form-control" required>
            <option value="teaching">Преподавательский состав</option>
            <option value="support">Учебно-вспомогательный состав</option>
            <option value="administrative">Административно-хозяйственный состав</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?= app()->route->getUrl('/departments') ?>" class="btn btn-secondary">Отмена</a>
</form>