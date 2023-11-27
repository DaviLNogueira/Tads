<?php

namespace App\Service;


use App\Exceptions\ValidationExeption;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Mockery\Exception;

class ValidarRequisao
{
    /**
     */
    public function ehUsuarioValido(Request $request): void
    {
        $token = $request->bearerToken();
        if (empty($token)){
           throw new Exception('Token não encontrado',400);
        }
        $this->comunicarComKeycloak($token);
    }

    /**
     * @throws GuzzleException
     */
    public function comunicarComKeycloak(string $token) : void
    {

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        $client = new Client();
        $response = $client->post('https://auth.facoffee.hsborges.dev/realms/facoffee/protocol/openid-connect/userinfo',$headers);
        dd($response);
    }
}
