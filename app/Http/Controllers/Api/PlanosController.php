<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\AssinaturaValidacao;
use App\Service\ValidarRequisao;
use Illuminate\Http\Request;
use App\Models\Plano;
use Illuminate\Support\Facades\Log;

class PlanosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/planos",
     *     summary="Buscar planos",
     *     description="Todos os planos",
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
    public function all(Request $request,ValidarRequisao $validarRequisao)
    {
        $validarRequisao->ehUsuarioValido($request);

    }

//    /**
//     * @OA\Post(
//     *     path="/planos",
//     *     summary="Novo Plano",
//     *     tags={"Planos"},
//     *     @OA\Parameter(
//     *         name="nome",
//     *         in="header",
//     *         description="nome do plano",
//     *         required=true,
//     *         @OA\Schema(type="string")
//     *     ),
//     *     @OA\Parameter(
//     *         name="descricao",
//     *         in="header",
//     *         description="descricao do plano",
//     *         required=true,
//     *         @OA\Schema(type="string")
//     *     ),
//     *     @OA\Parameter(
//     *         name="preco",
//     *         in="header",
//     *         description="preco do plano",
//     *         required=true,
//     *         @OA\Schema(type="float")
//     *     ),
//     *     @OA\Response(response="201", description="Plano registrado com sucesso"),
//     *     @OA\Response(response="422", description="Erro na validação")
//     * )
//     */
//    public function new(Request $request){
//        $planodata = $request->all();
//        try {
//            $plano = new Plano::create([
//                'nome' => $planodata['nome'],
//                'preco' =>$planodata['preco'],
//                'descricao' => $planodata['descricao'],
//            ]);
//            $plano->save();
//
//        }catch (\Exception $e){
//            Log::alert($e->getMessage());
//        }
//
//    }
//
//    /**
//     * @OA\Delete(
//     *     path="/palnos/{id}",
//     *     summary="Excluir um plano",
//     *     tags={"Planos"},
//     *     @OA\Parameter(
//     *         name="id",
//     *         in="path",
//     *         description="id do plano",
//     *         required=true,
//     *         @OA\Schema(type="integer")
//     *     ),
//     *     @OA\Response(response="201", description="Plano exluido com sucesso"),
//     *     @OA\Response(response="422", description="Erro na validação")
//     * )
//     * @throws \Exception
//     */
//
//    public function delete(int $id,AssinaturaValidacao $service)
//    {
//
//        $plano = Plano::find($id);
//        $service->validarExclusao($plano);
//        $plano->delete();
//    }
//
//    /**
//     * @OA\Patch(
//     *     path="/planos/{id}",
//     *     summary="Atualizar um plano",
//     *     tags={"Planos"},
//     *     @OA\Parameter(
//     *         name="nome",
//     *         in="header",
//     *         required=true,
//     *         @OA\Schema(type="string")
//     *     ),
//     *     @OA\Parameter(
//     *         name="descricao",
//     *         in="header",
//     *         required=true,
//     *         @OA\Schema(type="string")
//     *     ),@OA\Parameter(
//     *         name="preco",
//     *         in="header",
//     *         required=true,
//     *         @OA\Schema(type="float")
//     *     ),
//     *     @OA\Parameter(
//     *         name="id",
//     *         in="path",
//     *         description="id do plano",
//     *         required=true,
//     *         @OA\Schema(type="integer")
//     *     ),
//     *     @OA\Response(response="201", description="Assinatura atualizada com sucesso"),
//     *     @OA\Response(response="422", description="Erro na validação")
//     * )
//     */
//
//    public  function edit(Request $request,int $id)
//    {
//        $planodata = $request->all();
//        $plano = Plano::find($id);
//        $plano->nome = $planodata['nome'];
//        $plano->preco = $planodata['preco'];
//        $plano->descricao = $planodata['descricao'];
//        $plano->save();
//    }
}
