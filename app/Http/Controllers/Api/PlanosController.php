<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plano;
use Illuminate\Support\Facades\Log;

class PlanosController extends Controller
{
    public function all ()
    {
        return Plano::all();
    }

    public function new(Request $request){
        $planodata = $request->all();
        try {
            $plano = new Plano::create([
                'nome' => $planodata['nome'],
                'preco' =>$planodata['preco'],
                'descricao' => $planodata['descricao'],
                'vigencia' => $planodata['vigencia']
            ]);
            $plano->save();

        }catch (\Exception $e){
            Log::alert($e->getMessage());
        }

    }


    public function delete(int $id)
    {
        $plano = Plano::find($id);
        $plano->delete();
    }

    public  function edit(Request $request,int $id)
    {
        $planodata = $request->all();
        $plano = Plano::find($id);
        $plano->nome = $planodata['nome'];
        $plano->preco = $planodata['preco'];
        $plano->descricao = $planodata['descricao'];
        $plano->vigencia = $planodata['vigencia'];
        $plano->save();
    }
}
