<h2>Статистика по возрасту сотрудников</h2>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number"><?= $totalEmployees ?></div>
        <div class="stat-label">Всего сотрудников</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $averageAge ?></div>
        <div class="stat-label">Средний возраст (лет)</div>
    </div>
</div>

<h3>Средний возраст по подразделениям</h3>

<table class="table">
    <thead>
    <tr>
        <th>Подразделение</th>
        <th>Количество сотрудников</th>
        <th>Средний возраст</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($ageByDepartment as $dept): ?>
        <tr>
            <td><?= htmlspecialchars($dept['name']) ?></td>
            <td><?= $dept['count'] ?></td>
            <td><?= $dept['average'] ?> лет</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div style="margin-top: 20px;">
    <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">← Назад к списку сотрудников</a>
</div>