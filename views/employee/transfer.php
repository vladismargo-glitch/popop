<h2>Перевод сотрудника</h2>

<?php if (isset($message)): ?>
    <div class="alert alert-danger">
        <?php
        $errors = json_decode($message, true);
        if (is_array($errors)) {
            foreach ($errors as $field => $errorMessages) {
                echo '• <strong>' . $field . '</strong>: ' . implode(', ', $errorMessages) . '<br>';
            }
        } else {
            echo htmlspecialchars($message);
        }
        ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-title">Сотрудник: <?= htmlspecialchars($employee->full_name) ?></div>
    <p><strong>Текущее подразделение:</strong> <?= htmlspecialchars($employee->department->name ?? 'Не указано') ?></p>
    <p><strong>Должность:</strong> <?= htmlspecialchars($employee->position) ?></p>
</div>

<form method="post" action="<?= app()->route->getUrl('/employees/transfer') ?>" class="card">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <input type="hidden" name="id" value="<?= $employee->id ?>">

    <div class="form-group">
        <label class="form-label">Новое подразделение</label>
        <select name="department_id" class="form-control" required>
            <option value="">-- Выберите подразделение --</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department->id ?>" <?= $employee->department_id == $department->id ? 'disabled' : '' ?>>
                    <?= htmlspecialchars($department->name) ?>
                    <?php if ($employee->department_id == $department->id): ?> (текущее)<?php endif; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="btn-group">
        <button type="submit" class="btn btn-primary">Перевести</button>
        <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Отмена</a>
    </div>
</form>