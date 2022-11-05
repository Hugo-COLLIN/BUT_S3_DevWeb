<?php

namespace iutnc\deefy\exception;

use Exception;

class AlreadyRegisteredException extends Exception
{
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Utilisateur déjà dans la base.", $code, $previous);
    }
}