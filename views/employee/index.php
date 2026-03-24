<h2>Список сотрудников</h2>

<?php if (isset($employees) && (app()->auth::user()->hasRole('hr') || app()->auth::user()->hasRole('admin'))): ?>
    <a href="<?= app()->route->getUrl('/employees/create') ?>" class="btn btn-primary mb-3">Добавить сотрудника</a>
<?php endif; ?>

<?php if (!isset($employees)): ?>
    <div class="alert alert-danger">
        <strong>Ошибка!</strong> Переменная $employees не передана в представление.
    </div>
<?php elseif ($employees->isEmpty()): ?>
    <div class="alert alert-info">
        Нет данных о сотрудниках. Добавьте первого сотрудника!
    </div>
<?php else: ?>
    <table class="table table-bordered">
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
                <td><?= htmlspecialchars($employee->full_name ?? $employee->last_name . ' ' . $employee->first_name) ?></td>
                <td><?= isset($employee->birth_date) ? date('d.m.Y', strtotime($employee->birth_date)) : 'Не указана' ?></td>
                <td><?= htmlspecialchars($employee->position ?? 'Не указана') ?></td>
                <td><?= htmlspecialchars($employee->department->name ?? 'Не указано') ?></td>
                <td>
                    <a href="<?= app()->route->getUrl('/employees/edit?id=' . $employee->id) ?>" class="btn btn-sm btn-warning">Редактировать</a>
                    <form action="<?= app()->route->getUrl('/employees/destroy') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <input type="hidden" name="id" value="<?= $employee->id ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить сотрудника?')">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>