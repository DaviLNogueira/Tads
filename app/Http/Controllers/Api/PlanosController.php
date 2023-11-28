<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\AssinaturaValidacao;
use App\Service\PlanoValidacao;
use Exception;
use Illuminate\Http\Request;
use App\Models\Plano;

class PlanosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/planos",
     *     summary="Buscar planos",
     *     description="Todos os planos",
     *     security={{"token": {}}},
     *     tags={"Planos"},
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
     *                          property="nome",
     *                          type="string",
     *                       ), @OA\Property(
     *                          property="preco",
     *                          type="float",
     *                       ),@OA\Property(
     *                          property="descricao",
     *                          type="string",
     *                       )
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
    public function all()
    {
        return Plano::all()->jsonSerialize();

    }

    /**
     * @OA\Post(
     *     path="/planos",
     *     summary="Novo Plano",
     *     security={{"token": {}}},
     *     tags={"Planos"},
     *      @OA\SecurityScheme(
     *       securityScheme="bearerAuth",
     *       in="header",
     *       name="bearerAuth",
     *       type="http",
     *       scheme="bearer",
     *       bearerFormat="JWT",
     *  ),
     *     @OA\Parameter(
     *         name="nome",
     *         in="header",
     *         description="nome do plano",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="descricao",
     *         in="header",
     *         description="descricao do plano",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="preco",
     *         in="header",
     *         description="preco do plano",
     *         required=true,
     *         @OA\Schema(type="float")
     *     ),
     *     @OA\Response(response="201", description="Plano registrado com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     * @throws Exception
     */
    public function new(Request $request, PlanoValidacao $validacao): void
    {
        $data = $request->all();
        $validacao->exigirCampos(['name', 'preco', 'descricao', 'vigencia'], $data);
        try {
            $plano = Plano::create([
                'name' => $data['name'],
                'preco' => $data['preco'],
                'descricao' => $data['descricao'],
                'vigencia' => $data['vigencia']
            ]);
            $plano->save();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * @OA\Delete(
     *     path="/planos/{id}",
     *     summary="Excluir um plano",
     *     tags={"Planos"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do plano",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="Plano exluido com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     * @throws Exception
     */

    public function delete(int $id, AssinaturaValidacao $service)
    {
        $plano = Plano::find($id);
        $service->validarExclusao($plano);
        $plano->delete();
    }

    /**
     * @OA\Patch(
     *     path="/planos/{id}",
     *     summary="Atualizar um plano",
     *     tags={"Planos"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="nome",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="descricao",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),@OA\Parameter(
     *         name="preco",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="float")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do plano",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="Assinatura atualizada com sucesso"),
     *     @OA\Response(response="422", description="Erro na validação")
     * )
     */

    public function edit(Request $request, int $id, PlanoValidacao $validacao)
    {
        $data = $request->all();
        $validacao->exigirCampos(['name', 'preco', 'descricao', 'vigencia'], $data);
        $plano = Plano::find($id);
        $plano->name = $data['name'];
        $plano->preco = $data['preco'];
        $plano->descricao = $data['descricao'];
        $plano->vigencia = $data['vigencia'];
        $plano->save();
    }
}
