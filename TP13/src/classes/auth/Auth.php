<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthException;

class Auth
{
    public static function authentificate()
    {
        $q = "SELECT * FROM USER WHERE id=?";

        db2_prepare(fbird_execute(


        ))
        fetch
        if (!$user) throw new AuthException("failed");
        if (!password_verify($pass))
    }
}