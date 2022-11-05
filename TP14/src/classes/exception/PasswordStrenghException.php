<?php

namespace iutnc\deefy\exception;

use Exception;

class PasswordStrenghException extends Exception
{
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Veuillez saisir un mot de passe plus robuste.", $code, $previous);
    }
}