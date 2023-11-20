<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use App\Models\Plano;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssinaturaControle extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Assinatura::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $assinaturaRequest = $request->all();
        $planoId = $assinaturaRequest['plano'];
        $cliente = $assinaturaRequest['cliente'];
        $vigencia = $assinaturaRequest['vigencia'];
        $plano = Plano::find($planoId);

        try {
            $plano = new Assinatura::create([
                'data_inicio' =>new DateTime('now'),
                'data_fim' => (new DateTime())->add($vigencia),
                'cliente_id' => $cliente,
                'status' => 'ativo',
                'plano' => $plano,

            ]);
            $plano->save();

        }catch (\Exception $e){
            Log::alert($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Assinatura::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assinaturaRequest = $request->all();
        $assinatura = Assinatura::find($id);
        $assinatura->data_termino = $assinaturaRequest['data_termino'];
        $assinatura->status = $assinaturaRequest['status'];
        $assinatura->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assinatura = Assinatura::find($id);
        $assinatura->delete();
    }
}
