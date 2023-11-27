<?php

namespace App\Exceptions;

use App\Service\ValidarRequisao;
use Exception;

class ValidationExeption extends Exception
{
    static public function tokenNotFound() : ValidationExeption
    {
        throw new ValidationExeption("Não foi encontrado o token da requisão");
    }
}
