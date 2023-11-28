<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareKeycloack
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (empty($token)) {
            throw new Exception('Token não encontrado', 401);
        }
        $this->comunicarComKeycloak($token);
        return $next($request);
    }

    public function comunicarComKeycloak(string $token): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ])->post('https://auth.facoffee.hsborges.dev/realms/facoffee/protocol/openid-connect/userinfo');
            if($response->status() >= 200 && $response->status() < 300){
                $this->salvarUserSessao($response->json());
            }
            elseif($response->status() >= 400 && $response->status() < 500){
                throw new Exception('Usuário não autorizado', 401);
            }
            else{
                throw new Exception('Houve um problema na comunicação com FACOFFEE', 401);
            }

        } catch (\Exception $exception) {
            throw new Exception(sprintf('Não foi possível comunicar com o FACOFFEE: %s',$exception->getMessage()), 401);
        }

    }

    public function salvarUserSessao(array $data) : void
    {
        session([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }
}
