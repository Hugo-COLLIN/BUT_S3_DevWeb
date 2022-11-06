<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when a property value is incorrect
 * @author Hugo COLLIN
 */
class InvalidPropertyValueException extends Exception
{
    /**
     * Exception inherited constructor
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Valeur de la propriété invalide.", $code, $previous);
    }
}