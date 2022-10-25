<?php

namespace iutnc\deefy\exception;

use Exception;

class AuthException extends Exception
{
    public function __construct(string $s = "Identifiant ou mot de passe incorrect.")
    {
        parent::__construct($s);
    }
}