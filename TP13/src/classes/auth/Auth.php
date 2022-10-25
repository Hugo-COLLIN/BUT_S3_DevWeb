<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthException;
use \iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\user\User;

class Auth
{
    /**
     * @throws AuthException
     */
    public static function authentificate(string $email, string $pwd) : User|null
    {
        $db = \iutnc\deefy\db\ConnectionFactory::makeConnection();
        $q = "SELECT * FROM USER WHERE email=?";
        $st = $db->prepare($q);

        if ($st->execute([$email])) {
            $user = $st->fetch(\PDO::FETCH_ASSOC);
            if ($user && password_verify($pwd, $user['passwd'])) {
                return new User($user['email'], $user['passwd'], $user['role']);
            }
            else throw new AuthException("Authentification failed : invalid credentials");
        }
        return null;
    }
}