<?php

namespace App\Exceptions;

use Exception;

class ValidationExeption extends Exception
{
    static public function tokenNotFound() : ValidationExeption
    {
        throw new ValidationExeption("Não foi encontrado o token da requisão");
    }
}
