<?php

namespace exceptions;

use Exception;

class NotEditablePropertyException extends Exception
{
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Impossible d'éditer la propriété.", $code, $previous);
    }
}