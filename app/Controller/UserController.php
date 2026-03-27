<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class UserController
{
    public function index(): string
    {
        $users = User::all();
        return (new View('user.index', ['users' => $users]))->render();
    }

    public function create(): string
    {
        return (new View('user.create'))->render();
    }

    public function store(Request $request): string
    {
        $name = $request->get('name');
        $login = $request->get('login');
        $password = $request->get('password');
        $role = $request->get('role');

        // Проверка на пустые поля
        if (empty($name) || empty($login) || empty($password)) {
            return (new View('user.create', ['message' => 'Все поля обязательны для заполнения']))->render();
        }

        $existingUser = User::where('login', $login)->first();
        if ($existingUser) {
            return (new View('user.create', ['message' => 'Пользователь с таким логином уже существует']))->render();
        }

        $user = new User();
        $user->name = $name;
        $user->login = $login;
        $user->password = md5($password);
        $user->role = $role ?? 'guest';

        if ($user->save()) {
            app()->route->redirect('/users');
            return '';
        }

        return (new View('user.create', ['message' => 'Ошибка создания пользователя']))->render();
    }

    public function setRole(Request $request): string
    {
        $user = User::find($request->get('id'));
        if ($user && $user->login !== 'admin') {
            $user->role = $request->get('role');
            $user->save();
        }
        app()->route->redirect('/users');
        return '';
    }

    public function destroy(Request $request): string
    {
        $user = User::find($request->get('id'));
        if ($user && $user->login !== 'admin') {
            $user->delete();
        }
        app()->route->redirect('/users');
        return '';
    }
}