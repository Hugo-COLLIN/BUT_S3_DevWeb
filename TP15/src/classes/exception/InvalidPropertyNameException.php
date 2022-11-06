<?php
namespace iutnc\deefy\exception;

//Autre solution : laisser le contenu de la classe vide, on hérite de Exception

use Exception;

/**
 * Exception thrown when a property name is incorrect
 * @author Hugo COLLIN
 */
class InvalidPropertyNameException extends Exception
{
    /**
     * Exception inherited constructor
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "Nom de la propriété invalide.", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}