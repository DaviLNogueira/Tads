<?php

namespace App\Service;

use Exception;

class PlanoValidacao
{

    /**
     * @throws Exception
     */
    public function exigirCampos(array $campos, array $data)
    {
        foreach ($campos as  $campo) {
            $contem = array_key_exists($campo,$data);
            if(!$contem){
                throw new Exception(sprintf("Exige o campo %s",$campo));
            }
        }
    }
}
