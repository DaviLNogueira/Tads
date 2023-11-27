<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class ValidarRequisao
{
    /**
     */
    public function ehUsuarioValido(Request $request): void
    {
        $token = $request->bearerToken();
        if (empty($token)) {
            throw new Exception('Token não encontrado', 400);
        }
        $this->comunicarComKeycloak($token);
    }

    public function comunicarComKeycloak(string $token): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ])->post('https://auth.facoffee.hsborges.dev/realms/facoffee/protocol/openid-connect/userinfo');
            if($response->status() >= 200 && $response->status() < 300){
                return;
            }
            if($response->status() >= 400 && $response->status() < 500){
                throw new Exception('Usuário não autorizado', 401);
            }
            else{
                throw new Exception('Houve um problema na comunicação com FACOFFEE', 401);
            }

        } catch (\Exception $exception) {
            throw new Exception('Não foi possível comunicar com o FACOFFEE', 401);
        }

    }
}
