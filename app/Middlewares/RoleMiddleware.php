<?php
namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request, string $role)
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
            return;
        }

        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            return;  // пропускаем
        }

        if ($userRole !== $role) {
            app()->route->redirect('/');
            return;
        }
    }
}