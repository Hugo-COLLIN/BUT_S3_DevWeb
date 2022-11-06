<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when a user is already in the database
 * @author Hugo COLLIN
 */
class AlreadyRegisteredException extends Exception
{
    /**
     * Exception inherited constructor
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Utilisateur déjà dans la base.", $code, $previous);
    }
}