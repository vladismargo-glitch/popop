<h2>Список сотрудников</h2>

<?php if (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin')): ?>
    <a href="<?= app()->route->getUrl('/employees/create') ?>" class="btn btn-success">➕ Добавить сотрудника</a>
<?php endif; ?>

<!-- Форма фильтрации -->
<form method="get" class="filter-form">
    <input type="text" name="search" placeholder="Поиск по фамилии или имени"
           value="<?= htmlspecialchars($search ?? '') ?>" class="form-control">

    <select name="department_id" class="form-control">
        <option value="">Все подразделения</option>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept->id ?>" <?= ($departmentId ?? '') == $dept->id ? 'selected' : '' ?>>
                <?= htmlspecialchars($dept->name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-primary">🔍 Найти</button>
    <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Сбросить</a>
</form>

<?php if ($employees->isEmpty()): ?>
    <div class="alert alert-info">Нет данных о сотрудниках</div>
<?php else: ?>
    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th>Дата рождения</th>
            <th>Должность</th>
            <th>Подразделение</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= htmlspecialchars($employee->full_name) ?></td>
                <td><?= isset($employee->birth_date) ? date('d.m.Y', strtotime($employee->birth_date)) : 'Не указана' ?></td>
                <td><?= htmlspecialchars($employee->position ?? 'Не указана') ?></td>
                <td><?= htmlspecialchars($employee->department->name ?? 'Не указано') ?></td>
                <td>
                    <a href="<?= app()->route->getUrl('/employees/edit?id=' . $employee->id) ?>" class="btn btn-warning btn-sm">✏️</a>
                    <form action="<?= app()->route->getUrl('/employees/destroy') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $employee->id ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить сотрудника?')">🗑️</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>