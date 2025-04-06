<?php

namespace App\Http\Controllers;

use App\Models\SalesItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class salesItemController extends Controller
{


    /**
     * @OA\Get(
     *     path="/sales_item",
     *     summary="Buscar todos os items vendidos no banco.",
     *     tags={"Itens de venda"},
     *     @OA\Response (response="200", description="test")
     * )
     *
     */

    public function index()
    {
        $salesItems = SalesItem::all();
        return Response()->json($salesItems);
    }

    public function create()
    {

    }


    /**
     * @OA\Post(
     *     path="/sales_item/create",
     *     summary="Cadastrar novo item de venda",
     *     tags={"Itens de venda"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"sales_item_date", "sale_id", "product_id", "quantity"},
     *             @OA\Property (property="sales_item_date", type="string", format="date", example="2025-04-06"),
     *             @OA\Property (property="sale_id", type="integer", example="1"),
     *             @OA\Property (property="product_id", type="integer", example="2"),
     *             @OA\Property (propert="quantity", type="integer", example="1"),
     *         )
     *     ),
     *     @OA\Response (
     *         response="201",
     *         description="Item de venda criado com sucesso",
     *         @OA\JsonContent (
     *             @OA\Property (property="sales_item_id", type="integer", example=1),
     *             @OA\Property (property="sales_item_date", type="string", format="date", example="2025-04-06"),
     *             @OA\Property (property="sale_id", type="integer", example="1"),
     *             @OA\Property (property="product_id", type="integer", example="2"),
     *         )
     *     ),
     *      @OA\Response (
     *          response="400",
     *          description="Dados inválidos"
     *      )
     * )
     *
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            "sales_item_date" => "required",
            "sale_id" => "required|exists:sales,sale_id",
            "product_id" => "required|exists:products,id",
            "quantity" => "required",
        ]);

        $salesItems = new Salesitem;
        $salesItems->sales_item_date = $request->input('sales_item_date');
        $salesItems->sale_id = $request->input('sale_id');
        $salesItems->product_id = $request->input('product_id');
        $salesItems->quantity = $request->input('quantity');
        $salesItems->save();
        return Response()->json($salesItems);
    }

    /**
     * @OA\Get(
     *     path="/sales_item/{sale_id}",
     *     summary="Buscar itens de venda de uma venda",
     *     tags={"Itens de venda"},
     *     @OA\Parameter (
     *         name="sale_id",
     *         in="path",
     *         description="Id da venda",
     *         required=true,
     *         @OA\Schema (type="integer")
     *         ),
     *         @OA\Response (
     *          response="200",
     *          description="Aqui estão os itens desta venda",
     *          @OA\JsonContent (
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property (property="sales_item_id", type="integer", example=1),
     *                  @OA\Property (property="sales_item_date", type="string", format="date", example="2025-04-06"),
     *                  @OA\Property (property="sale_id", type="integer", example="1"),
     *                  @OA\Property (property="product_id", type="integer", example="2"),
     *              )
     *
     *          )
     *      ),
     *       @OA\Response (
     *           response="400",
     *           description="Dados inválidos"
     *       )
     *     ),
     *
     * )
     *
     */

    public function show($id)
    {
        $salesItems = SalesItem::where('sale_id', $id)->get();
        return response()->json($salesItems);
    }

    public function edit($id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/sales_item/update/{id}",
     *     summary="Alterar um cadastro",
     *     tags={"Itens de venda"},
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="Id do item de venda",
     *          required=true,
     *          @OA\Schema (type="integer")
     *          ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"sales_item_date", "sale_id", "product_id", "quantity"},
     *              @OA\Property (property="sales_item_date", type="string", format="date", example="2025-04-06"),
     *              @OA\Property (property="sale_id", type="integer", example="1"),
     *              @OA\Property (property="product_id", type="integer", example="2"),
     *         )
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="Item de venda alterado com sucesso",
     *         @OA\JsonContent (
     *          @OA\Property (property="sales_item_date", type="string", format="date", example="2025-04-06"),
     *               @OA\Property (property="sale_id", type="integer", example="1"),
     *               @OA\Property (property="product_id", type="integer", example="2"),
     *         )
     *     ),
     *      @OA\Response (
     *          response="400",
     *          description="Dados inválidos"
     *      )
     * )
     *
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "sale_id" => "required|exists:sales,sale_id",
            "product_id" => "required|exists:products,id",
            "quantity" => "required",
        ]);

        $salesItems = SalesItem::find($id);
        $salesItems->sale_id = $request->input('sale_id');
        $salesItems->product_id = $request->input('product_id');
        $salesItems->quantity = $request->input('quantity');
        $salesItems->save();
        return Response()->json($salesItems);
    }

    /**
     * @OA\Delete(
     *     path="/sales_item/delete/{sales_item_id}",
     *     summary="Deletar um item de venda pelo ID",
     *     tags={"Itens de venda"},
     *     @OA\Parameter(
     *         name="sales_item_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Item de venda deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item de venda não encontrado"
     *     )
     * )
     */

    public function destroy($id)
    {
        $salesItems = SalesItem::find($id);
        $salesItems->delete();
        return Response()->json($salesItems);
    }
}
