<?php
namespace iutnc\deefy\exception;

//Autre solution : laisser le contenu de la classe vide, on hérite de Exception

use Exception;

class InvalidPropertyNameException extends Exception
{
    public function __construct($message = "", int $code = 0, Exception $previous = null)
    {
        if (empty($message))
            $message = "Nom de la propriété invalide.";
        parent::__construct($message, $code, $previous);
    }
}