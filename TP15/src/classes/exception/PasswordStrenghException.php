<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when a property name is incorrect
 * @author Hugo COLLIN
 */
class PasswordStrenghException extends Exception
{
    /**
     * Exception inherited constructor
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Veuillez saisir un mot de passe plus robuste.", $code, $previous);
    }
}