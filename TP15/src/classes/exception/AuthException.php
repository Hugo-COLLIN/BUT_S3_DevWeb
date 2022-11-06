<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when authentification fails
 * @author Hugo COLLIN
 */
class AuthException extends Exception
{
    /**
     * Exception inherited constructor
     * @param string $s
     */
    public function __construct(string $s = "Identifiant ou mot de passe incorrect.")
    {
        parent::__construct($s);
    }
}