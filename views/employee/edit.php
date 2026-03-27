<h2>Редактирование сотрудника</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/employees/update') ?>" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <input type="hidden" name="id" value="<?= $employee->id ?>">

    <div class="form-group">
        <label class="form-label">Фамилия</label>
        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee->last_name) ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Имя</label>
        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee->first_name) ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Отчество</label>
        <input type="text" name="patronymic" class="form-control" value="<?= htmlspecialchars($employee->patronymic) ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Пол</label>
        <div>
            <label class="form-check"><input type="radio" name="gender" value="male" <?= $employee->gender == 'male' ? 'checked' : '' ?> required> Мужской</label>
            <label class="form-check"><input type="radio" name="gender" value="female" <?= $employee->gender == 'female' ? 'checked' : '' ?> required> Женский</label>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Дата рождения</label>
        <input type="date" name="birth_date" class="form-control" value="<?= $employee->birth_date ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Адрес</label>
        <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($employee->address) ?></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Должность</label>
        <input type="text" name="position" class="form-control" value="<?= htmlspecialchars($employee->position) ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Подразделение</label>
        <select name="department_id" class="form-control">
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department->id ?>" <?= $employee->department_id == $department->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($department->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Отмена</a>
</form>