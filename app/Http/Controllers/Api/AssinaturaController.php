<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use App\Models\Plano;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssinaturaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/assinatura",
     *     summary="Buscar assinaturas",
     *     description="Todas as assinaturas",
     *     tags={"Assinaturas"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          description="The response data",
     *                          items = @OA\Items(
     *                              @OA\Property(
     *                          property="data_inicio",
     *                          type="datetime",
     *                       ), @OA\Property(
     *                          property="data_termino",
     *                          type="datetime",
     *                       ),@OA\Property(
     *                          property="status",
     *                          type="string",
     *                       ),@OA\Property(
     *                          property="plano_id",
     *                          type="integer",
     *                       ),@OA\Property(
     *                          property="cliente_id",
     *                          type="integer",
     *                       ),
     *                          )
     *                      ),
     *                      example={
     *                          "errcode": 1,
     *                          "errmsg": "ok",
     *                          "data": {}
     *                      }
     *                  )
     *              )
     *          }
     *
     *     )
     * )
     */
    public function index()
    {
        return Assinatura::all();
    }

    /**
     * @OA\Post(
     *     path="/assinatura",
     *     summary="Assinatura",
     *     tags={"Assinaturas"},
     *     @OA\Parameter(
     *         name="plano",
     *         in="header",
     *         description="id do plano",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="cliente",
     *         in="header",
     *         description="Id do cliente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="vigencia",
     *         in="header",
     *         description="Dias de vigência do plano",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="Assinatura registrada com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     */
    public function store(Request $request)
    {
//        $assinaturaRequest = $request->all();
//        $planoId = $assinaturaRequest['plano'];
//        $cliente = $assinaturaRequest['cliente'];
//        $vigencia = $assinaturaRequest['vigencia'];
//        $plano = Plano::find($planoId);
//
//        try {
//            $plano = new Assinatura::create([
//                'data_inicio' =>new DateTime('now'),
//                'data_fim' => (new DateTime())->add($vigencia),
//                'cliente_id' => $cliente,
//                'status' => 'ativo',
//                'plano' => $plano,
//
//            ]);
//            $plano->save();
//
//        }catch (\Exception $e){
//            Log::alert($e->getMessage());
//        }
    }

    /**
     * @OA\Get(
     *     path="/assinatura/{id}",
     *     summary="Buscar um assinatura especifica",
     *     tags={"Assinaturas"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id da assinatura",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *
     *                        @OA\Property(
     *                          property="data_inicio",
     *                          type="datetime",
     *                       ), @OA\Property(
     *                          property="data_termino",
     *                          type="datetime",
     *                       ),@OA\Property(
     *                          property="status",
     *                          type="string",
     *                       ),@OA\Property(
     *                          property="plano_id",
     *                          type="integer",
     *                       ),@OA\Property(
     *                          property="cliente_id",
     *                          type="integer",
     *                       )
     * )
     *              )
     *          }
     *
     *     )
     * )
     */
    public function show(string $id)
    {
        return Assinatura::find($id);
    }

    /**
     * @OA\Patch(
     *     path="/assinatura/{id}",
     *     summary="Atualizar Assinatura",
     *     tags={"Assinaturas"},
     *     @OA\Parameter(
     *         name="data_termino",
     *         in="header",
     *         description="No data de termino",
     *         required=true,
     *         @OA\Schema(type="datetime")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="header",
     *         description="Novo status ",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id da assinatura",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="Assinatura atualizada com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
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
     * @OA\Delete(
     *     path="/assinatura/{id}",
     *     summary="Excluir uma assinatura",
     *     tags={"Assinaturas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id da assinatura",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="Assinatura exluida com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     */
    public function destroy(string $id)
    {
        $assinatura = Assinatura::find($id);
        $assinatura->delete();
    }
}
