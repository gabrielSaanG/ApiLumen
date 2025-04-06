<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class salesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/sales",
     *     summary="Buscar todas as vendas no banco.",
     *     tags={"Venda"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vendas retornada com sucesso",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="sale_id", type="integer", example=1),
     *                 @OA\Property(property="sale_date", type="string", format="date", example="2025-05-10"),
     *                 @OA\Property(property="total_value", type="number", format="float", example=149.99),
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        $sales = Sales::all();
        return Response()->json($sales);
    }


    public function create()
    {
        //
    }


    /**
     * @OA\Post(
     *     path="/sales/create",
     *     summary="Criar uma nova venda",
     *     tags={"Venda"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"sale_date", "total_value"},
     *             @OA\Property(property="sale_date", type="string", format="date", example="2025-04-06"),
     *             @OA\Property(property="total_value", type="number", format="float", example=299.90)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Venda criada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            "sale_date" => "required",
            'total_value' => "required",
        ]);

        $sales = new Sales;
        $sales->sale_date = $request->input('sale_date');
        $sales->total_value = $request->input('total_value');
        $sales->save();

        return response()->json($sales, 201);
    }

    /**
     * @OA\Get(
     *     path="/sales/{id}",
     *     summary="Buscar uma venda pelo ID",
     *     tags={"Venda"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da venda",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venda encontrada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="sale_date", type="string", format="date", example="2025-04-06"),
     *             @OA\Property(property="total_value", type="number", format="float", example=299.90),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-06T12:34:56Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-06T14:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venda não encontrada"
     *     )
     * )
     */

    public function show($id)
    {
        $sales = Sales::find($id);
        if (!$sales) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        return Response()->json($sales);
    }


    public function edit($id)
    {
        //
    }


    /**
     * @OA\Post  (
     *     path="/sales/update/{sale_id}",
     *     summary="Atualizar uma venda existente",
     *     tags={"Venda"},
     *     @OA\Parameter(
     *         name="sale_id",
     *         in="path",
     *         required=true,
     *         description="ID da venda",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"sale_date", "total_value"},
     *             @OA\Property(property="sale_date", type="string", format="date", example="2025-04-06"),
     *             @OA\Property(property="total_value", type="number", format="float", example=299.90)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venda atualizada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venda não encontrada"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "sale_date" => "required",
            "total_value" => "required",
        ]);

        $sales = Sales::find($id);
        if (!$sales) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }
        $sales->sale_date = $request->input('sale_date');
        $sales->total_value = $request->input('total_value');
        $sales->save();
        return response()->json($sales);
    }

    /**
     * @OA\Delete(
     *     path="/sales/delete/{sale_id}",
     *     summary="Deletar uma venda",
     *     tags={"Venda"},
     *     @OA\Parameter(
     *         name="sale_id",
     *         in="path",
     *         required=true,
     *         description="ID da venda",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venda deletada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venda não encontrada"
     *     )
     * )
     */


    public function destroy($id)
    {
        $sale = Sales::find($id);
        if (!$sale) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }
        $sale->delete();
        return response()->json(['message' => 'Venda deletada com sucesso']);
    }
}
