<?php

namespace App\Service;

use App\Models\Assinatura;
use App\Models\Plano;
use Exception;

class AssinaturaValidacao
{

    /**
     * @throws Exception
     */
    public function validarExclusao(Plano $plano) : void
    {
        $activeSubscriptions = Assinatura::where('plano_id', $plano->plano_id)->where('status', 'ativo')->count();

        if ($activeSubscriptions > 0) {
            throw new Exception('Não é possível excluir o plano porque há assinaturas ativas associadas a ele.');
        }

    }

    /**
     * @throws Exception
     */
    public function exigirCampos(array $campos, array $data)
    {
        foreach ($campos as  $campo) {
            $contem = array_key_exists($campo,$data);
            if(!$contem){
                throw new Exception(sprintf("Exige o campo %s",$campo),422);
            }
        }
    }
}
