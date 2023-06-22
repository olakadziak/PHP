<?php
namespace Services;
use Exception;
use Models\User;

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['username']);
    }

    /**
     * @throws Exception
     */
    public static function attempt(string $username, string $password): bool
    {
        $user = User::find($username, $password);
        if ($user->id){
            $_SESSION['username'] = $user->username;
            $_SESSION['id'] = $user->id;
            return true;
        }
        throw new Exception('Invalid username or password');
    }

    public static function logout(): void
    {
        session_destroy();
    }


    public static function id(): int
    {
        return $_SESSION['id'];
    }
}