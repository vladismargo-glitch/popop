<?php
namespace Src\Auth;

use Src\Session;
use Model\UserLog;

class Auth
{
    private static IdentityInterface $user;
    private static bool $logged = false;

    public static function init(IdentityInterface $user): void
    {
        self::$user = $user;
        if (self::user()) {
            self::$user = self::user();
            self::$logged = true;
        }
    }

    public static function login(IdentityInterface $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
        self::log('login');
        self::$logged = true;
    }

    public static function attempt(array $credentials): bool
    {
        if ($user = self::$user->attemptIdentity($credentials)) {
            self::login($user);
            return true;
        }
        return false;
    }

    public static function user()
    {
        $id = Session::get('id') ?? 0;
        return self::$user->findIdentity($id);
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): bool
    {
        self::log('logout');
        Session::clear('id');
        self::$logged = false;
        return true;
    }

    public static function generateCSRF(): string
    {
        if (!Session::get('csrf_token')) {
            $token = md5(time());
            Session::set('csrf_token', $token);
        }
        return Session::get('csrf_token');
    }

    private static function log($action): void
    {
        if (self::$logged && $action === 'login') {
            return;
        }

        if (self::user()) {
            UserLog::create([
                'user_id' => self::user()->getId(),
                'user_name' => self::user()->name,
                'action' => $action,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
            ]);
        }
    }
}