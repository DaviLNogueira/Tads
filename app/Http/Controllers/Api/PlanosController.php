<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plano;

class PlanosController extends Controller
{
    public function index () : array
    {
        $planos = Plano::paginate();
        return PlanoResource::collection($planos);
    }

    public function newPlano(Request $request) : array{
        $data = $request->all();
        $plano = Plano::create($data);
        return  $plano;
    }
}
