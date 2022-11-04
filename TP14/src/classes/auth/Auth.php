<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthException;
use \iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\PasswordStrenghException;
use iutnc\deefy\user\User;

class Auth
{
    /**
     * @throws AuthException
     */
    public static function authentificate(string $email, string $pwd)
    {
        $db = ConnectionFactory::makeConnection();
        $q = "SELECT * FROM USER WHERE email=?";
        $st = $db->prepare($q);
        $res = $st->execute([$email]);

        if (!$res) throw new AuthException();

        $user = $st->fetch(\PDO::FETCH_ASSOC);

        if (!$user) throw new AuthException();

        if (!password_verify($pwd, $user['passwd'])) throw new AuthException();

        //ou dans loadProfile
        $user = new User($email, $user['passwd'], $user['role']);
        $_SESSION['user'] = serialize($user);
/*
        if () {
            $user = $st->fetch(\PDO::FETCH_ASSOC);
            if ($user && password_verify($pwd, $user['passwd'])) {
                return new User($user['email'], $user['passwd'], $user['role']);
            }
            else throw new AuthException("Authentification failed : invalid credentials");
        }*/
        //return null;
    }

    public static function loadProfile(string $email)
    {
        $db = ConnectionFactory::makeConnection();
        $q = "SELECT * from user where email = ?";
        $st = $db->prepare($q);
        //$res = $st->execute([$email]);

        $user = $st->fetch(\PDO::FETCH_ASSOC);

        if ($st->execute([$email])) {
                return new User($user['email'], $user['passwd'], $user['role']);
        }
    }

    public static function checkPasswordStrengh(string $pass, $num) : bool
    {
        return true;
    }

    /**
     * @throws PasswordStrenghException
     */
    public static function register(string $mail, string $pass)
    {
        if (!self::checkPasswordStrengh($pass, 4))
            throw new PasswordStrenghException();

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        ConnectionFactory::makeConnection();

        //$query_email = ;

    }


/*
    public static function checkaccesslevel ()
    {
        if ($user->role === User::ADMIN_USER) return;

        $q;
        makeco;

        execute (user->email, $plId);
        if (!res) throw

        $st = $user->fetch
            ;
        if (!res) throw
    }
*/
}