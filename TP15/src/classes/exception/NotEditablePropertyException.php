<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when a property isn't editable
 * @author Hugo COLLIN
 */
class NotEditablePropertyException extends Exception
{
    /**
     * Exception inherited constructor
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $code = 0, Exception $previous = null)
    {
        parent::__construct("Impossible d'éditer la propriété.", $code, $previous);
    }
}