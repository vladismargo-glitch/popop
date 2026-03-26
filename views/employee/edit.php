<h2>Редактирование сотрудника</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" action="<?= app()->route->getUrl('/employees/update') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <input type="hidden" name="id" value="<?= $employee->id ?>">

    <div class="mb-3">
        <label for="last_name" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($employee->last_name) ?>" required>
    </div>

    <div class="mb-3">
        <label for="first_name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($employee->first_name) ?>" required>
    </div>

    <div class="mb-3">
        <label for="patronymic" class="form-label">Отчество</label>
        <input type="text" class="form-control" id="patronymic" name="patronymic" value="<?= htmlspecialchars($employee->patronymic) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Пол</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" <?= $employee->gender == 'male' ? 'checked' : '' ?> required>
            <label class="form-check-label" for="gender_male">Мужской</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" <?= $employee->gender == 'female' ? 'checked' : '' ?> required>
            <label class="form-check-label" for="gender_female">Женский</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="birth_date" class="form-label">Дата рождения</label>
        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= $employee->birth_date ?>" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Адрес</label>
        <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($employee->address) ?></textarea>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">Должность</label>
        <input type="text" class="form-control" id="position" name="position" value="<?= htmlspecialchars($employee->position) ?>" required>
    </div>

    <div class="mb-3">
        <label for="department_id" class="form-label">Подразделение</label>
        <select class="form-control" id="department_id" name="department_id">
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