<h2>Добавление нового подразделения</h2>

<?php if (isset($message)): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/departments/store') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div style="margin-bottom: 15px;">
        <label>Название подразделения:</label><br>
        <input type="text" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Тип подразделения:</label><br>
        <select name="type" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="teaching">Преподавательский состав</option>
            <option value="support">Учебно-вспомогательный состав</option>
            <option value="administrative">Административно-хозяйственный состав</option>
        </select>
    </div>

    <div>
        <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 4px;">Сохранить</button>
        <a href="<?= app()->route->getUrl('/departments') ?>" style="margin-left: 10px;">Отмена</a>
    </div>
</form>