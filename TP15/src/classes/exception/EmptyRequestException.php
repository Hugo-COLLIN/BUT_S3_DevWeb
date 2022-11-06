<?php

namespace iutnc\deefy\exception;

use Exception;

/**
 * Exception thrown when a request give no result
 * @author Hugo COLLIN
 */
class EmptyRequestException extends Exception
{
    /**
     * Exception inherited constructor
     * @param string $s
     */
    public function __construct(string $s = "Aucun résultat dans la base")
    {
        parent::__construct($s);
    }
}