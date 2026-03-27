<?php
namespace Controller;

use Model\UserLog;
use Src\View;

class AdminController
{
    public function activity(): string
    {
        $logs = UserLog::orderBy('created_at', 'desc')->limit(100)->get();
        return (new View('admin.activity', ['logs' => $logs]))->render();
    }
}