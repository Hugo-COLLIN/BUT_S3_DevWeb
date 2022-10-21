<?php

namespace iutnc\deefy\exception;

use Exception;

class AuthException extends Exception
{
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Identifiant ou mot de passe incorrect.");
    }
}