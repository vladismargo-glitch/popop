<h2>Добавление нового сотрудника</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/employees/store') ?>" enctype="multipart/form-data" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label class="form-label">Фамилия</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Имя</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Отчество</label>
        <input type="text" name="patronymic" class="form-control">
    </div>

    <div class="form-group">
        <label class="form-label">Пол</label>
        <div>
            <label class="form-check"><input type="radio" name="gender" value="male" required> Мужской</label>
            <label class="form-check"><input type="radio" name="gender" value="female" required> Женский</label>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Дата рождения</label>
        <input type="date" name="birth_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Адрес</label>
        <textarea name="address" class="form-control" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Должность</label>
        <input type="text" name="position" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Подразделение</label>
        <select name="department_id" class="form-control">
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department->id ?>"><?= htmlspecialchars($department->name) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Отмена</a>
</form>