<?php
namespace Controller;

use Model\UserLog;
use Model\Setting;
use Src\Request;
use Src\View;

class AdminController
{
    public function activity(): string
    {
        $logs = UserLog::orderBy('created_at', 'desc')->limit(100)->get();
        return (new View('admin.activity', ['logs' => $logs]))->render();
    }

    public function backup(): void
    {
        $dbConfig = app()->settings->getDbSetting();

        $host = $dbConfig['host'];
        $database = $dbConfig['database'];
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];

        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="backup_' . $database . '_' . date('Y-m-d_H-i-s') . '.sql"');

        $command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} 2>&1";

        $output = shell_exec($command);

        if ($output) {
            echo $output;
        } else {
            $this->backupViaPhp($host, $database, $username, $password);
        }
        exit();
    }

    private function backupViaPhp($host, $database, $username, $password): void
    {
        try {
            $pdo = new \PDO("mysql:host={$host};dbname={$database}", $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $tables = $pdo->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);

            $output = "-- Backup created: " . date('Y-m-d H:i:s') . "\n";
            $output .= "-- Database: {$database}\n\n";
            $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $create = $pdo->query("SHOW CREATE TABLE {$table}")->fetch(\PDO::FETCH_ASSOC);
                $output .= "DROP TABLE IF EXISTS `{$table}`;\n";
                $output .= $create['Create Table'] . ";\n\n";

                $rows = $pdo->query("SELECT * FROM {$table}");
                while ($row = $rows->fetch(\PDO::FETCH_ASSOC)) {
                    $values = array_map(function($value) use ($pdo) {
                        return $value === null ? 'NULL' : $pdo->quote($value);
                    }, $row);
                    $output .= "INSERT INTO `{$table}` VALUES (" . implode(', ', $values) . ");\n";
                }
                $output .= "\n";
            }

            $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

            echo $output;

        } catch (\PDOException $e) {
            echo "-- Ошибка экспорта: " . $e->getMessage();
        }
    }

    public function exportLogs(): void
    {
        $logs = UserLog::orderBy('created_at', 'desc')->get();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="audit_log_' . date('Y-m-d_H-i-s') . '.csv"');

        $output = fopen('php://output', 'w');

        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, [
            'ID',
            'ID пользователя',
            'Пользователь',
            'Действие',
            'IP адрес',
            'Дата и время'
        ]);

        foreach ($logs as $log) {
            $actionText = $log->action == 'login' ? '🔓 Вход' : '🔒 Выход';

            fputcsv($output, [
                $log->id,
                $log->user_id,
                $log->user_name,
                $actionText,
                $log->ip_address ?? '-',
                date('d.m.Y H:i:s', strtotime($log->created_at))
            ]);
        }

        fclose($output);
        exit();
    }

    public function restoreForm(): string
    {
        return (new View('admin.restore'))->render();
    }

    public function restore(Request $request): string
    {
        $file = $request->files()['backup_file'] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return (new View('admin.restore', ['message' => 'Ошибка загрузки файла', 'type' => 'danger']))->render();
        }

        $dbConfig = app()->settings->getDbSetting();

        try {
            $pdo = new \PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}",
                $dbConfig['username'],
                $dbConfig['password']
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $sql = file_get_contents($file['tmp_name']);

            $queries = array_filter(array_map('trim', explode(";\n", $sql)));

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

            foreach ($queries as $query) {
                if (!empty($query)) {
                    $pdo->exec($query);
                }
            }

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

            return (new View('admin.restore', ['message' => '✅ База данных успешно восстановлена!', 'type' => 'success']))->render();

        } catch (\PDOException $e) {
            return (new View('admin.restore', ['message' => '❌ Ошибка восстановления: ' . $e->getMessage(), 'type' => 'danger']))->render();
        }
    }
    public function settings(): string
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Отдел кадров'),
            'site_email' => Setting::get('site_email', 'hr@company.ru'),
            'site_phone' => Setting::get('site_phone', '+7 (495) 123-45-67'),
            'site_address' => Setting::get('site_address', 'г. Москва, ул. Примерная, д. 1'),
            'maintenance_mode' => Setting::get('maintenance_mode', '0'),
        ];

        return (new View('admin.settings', ['settings' => $settings]))->render();
    }

    // Сохранение настроек
    public function saveSettings(Request $request): string
    {
        $fields = ['site_name', 'site_email', 'site_phone', 'site_address', 'maintenance_mode'];

        foreach ($fields as $field) {
            $value = $request->get($field);
            if ($value !== null) {
                Setting::set($field, $value);
            }
        }

        return (new View('admin.settings', [
            'settings' => [
                'site_name' => Setting::get('site_name'),
                'site_email' => Setting::get('site_email'),
                'site_phone' => Setting::get('site_phone'),
                'site_address' => Setting::get('site_address'),
                'maintenance_mode' => Setting::get('maintenance_mode'),
            ],
            'message' => '✅ Настройки сохранены!',
            'type' => 'success'
        ]))->render();
    }
}