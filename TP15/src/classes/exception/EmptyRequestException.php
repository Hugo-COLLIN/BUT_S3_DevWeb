<?php

namespace iutnc\deefy\exception;

use Exception;

class EmptyRequestException extends Exception
{
    public function __construct(string $s = "Aucun résultat dans la base")
    {
        parent::__construct($s);
    }
}