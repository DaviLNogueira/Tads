<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use App\Models\Plano;
use App\Service\AssinaturaValidacao;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class AssinaturaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/assinatura",
     *     summary="Buscar assinaturas",
     *     description="Todas as assinaturas",
     *     tags={"Assinaturas"},
     *     security={{"token": {}}},
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
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="plano_id",
     *         in="header",
     *         description="id do plano",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Assinatura registrada com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     * @throws Exception
     */
    public function store(Request $request, AssinaturaValidacao $validacao)
    {
        $data = $request->all();
        $validacao->exigirCampos(['plano_id'], $data);
        $plano = Plano::find($data['plano_id']);
        $assinatura = Assinatura::newAssinatura($plano);
//         Obtenha a assinatura atual do cliente
        $assinaturaAtual = Assinatura::where('email', session('email'))->first();
        // Se o usuário não tiver nenhuma assinatura ou se a assinatura atual estiver inativa
        if (!$assinaturaAtual || $assinaturaAtual->status != 'ativo') {
            return  $assinatura->jsonSerialize();
        } else {
            throw new Exception("Usuário com asssinatura ativa");
        }
    }

    /**
     * @OA\Get(
     *     path="/assinatura/{id}",
     *     summary="Buscar um assinatura especifica",
     *     tags={"Assinaturas"},
     *     security={{"token": {}}},
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
     *     security={{"token": {}}},
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
     * @throws Exception
     */
    public function update(Request $request, string $id,AssinaturaValidacao $validacao)
    {
        $data = $request->all();
        $validacao->exigirCampos(['data_termino','status'],$data);
        $assinatura = Assinatura::find($id);

        $assinatura->data_termino = (new DateTime($data['data_termino']))->format('Y-m-d');
        $assinatura->status = $data['status'];
        $assinatura->save();
        return $assinatura;

    }

    /**
     * @OA\Delete(
     *     path="/assinatura/{id}",
     *     summary="Excluir uma assinatura",
     *     tags={"Assinaturas"},
     *     security={{"token": {}}},
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

    /**
     * @OA\Get(
     *     path="/cliente/{id}",
     *     summary="Buscar as assinaturas do cliente",
     *     tags={"Assinaturas"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id da cliente",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           content={
     *               @OA\MediaType(
     *                   mediaType="application/json",
     *                   @OA\Schema(
     *                       @OA\Property(
     *                           property="data",
     *                           type="array",
     *                           description="The response data",
     *                           items = @OA\Items(
     *                               @OA\Property(
     *                           property="data_inicio",
     *                           type="datetime",
     *                        ), @OA\Property(
     *                           property="data_termino",
     *                           type="datetime",
     *                        ),@OA\Property(
     *                           property="status",
     *                           type="string",
     *                        ),@OA\Property(
     *                           property="plano_id",
     *                           type="integer",
     *                        ),@OA\Property(
     *                           property="cliente_id",
     *                           type="integer",
     *                        ),
     *                           )
     *                       ),
     *                       example={
     *                           "errcode": 1,
     *                           "errmsg": "ok",
     *                           "data": {}
     *                       }
     *                   )
     *               )
     *           }
     *
     *      )
     * )
     */
    public function getAssinaturaByClienteId()
    {
        return Assinatura::where('email', session('email'))->first();
    }
}
