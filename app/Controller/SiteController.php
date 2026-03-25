<?php
namespace Controller;

use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\View;

class SiteController
{
    public function index(): string
    {
        return new View('site.index');
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            // Получаем данные из формы
            $name = $request->get('name');
            $login = $request->get('login');
            $password = $request->get('password');

            // Проверяем, что поля не пустые
            if (empty($name) || empty($login) || empty($password)) {
                return new View('site.signup', ['message' => 'Все поля обязательны для заполнения']);
            }

            // Проверяем, что логин не занят
            $existingUser = User::where('login', $login)->first();
            if ($existingUser) {
                return new View('site.signup', ['message' => 'Пользователь с таким логином уже существует']);
            }

            // Создаем пользователя
            $user = new User();
            $user->name = $name;
            $user->login = $login;
            $user->password = md5($password);
            $user->role = 'guest';

            if ($user->save()) {
                app()->route->redirect('/login');
                return '';
            }

            return new View('site.signup', ['message' => 'Ошибка регистрации']);
        }

        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
            return '';
        }

        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }
}