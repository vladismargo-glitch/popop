<?php
namespace Controller;

use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class SiteController
{
    // Главная страница
    public function index(): string
    {
        return (new View('site.index'))->render();  // ИСПРАВЛЕНО: добавили ->render()
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return (new View('site.signup', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]))->render();
            }

            $user = new User();
            $user->name = $request->get('name');
            $user->login = $request->get('login');
            $user->password = md5($request->get('password'));
            $user->role = 'guest';

            if ($user->save()) {
                app()->route->redirect('/login');
                return '';
            }

            return (new View('site.signup', ['message' => 'Ошибка регистрации']))->render();
        }

        return (new View('site.signup'))->render();
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View('site.login'))->render();
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
            return '';
        }

        return (new View('site.login', ['message' => 'Неправильные логин или пароль']))->render();
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }
}