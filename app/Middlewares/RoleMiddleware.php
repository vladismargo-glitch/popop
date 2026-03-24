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
        }

        if (!Auth::user()->hasRole($role)) {
            app()->route->redirect('/');
        }
    }
}