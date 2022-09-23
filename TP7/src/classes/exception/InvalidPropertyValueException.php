<?php

namespace iutnc\deefy\audio\exception;

use Exception;

class InvalidPropertyValueException extends Exception
{
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Valeur de la propriété invalide.", $code, $previous);
    }
}