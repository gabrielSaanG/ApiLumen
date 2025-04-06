<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;


class ProductsController extends Controller
{

    /**
     * @OA\Get(
     *     path="/products",
     *     summary="Buscar todos os produtos no banco.",
     *     tags={"Produto"},
     *     @OA\Response (response="200", description="test")
     * )
     *
     */

    public function index()
    {
        $products = Products::all();
        return Response()->json($products);
    }


    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/products/create",
     *     summary="Cadastrar novo produto",
     *     tags={"Produto"},
     *     description="OBS: id do fabricante deve ser válido!",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_name", "product_description", "fabrication_date", "expiration_date", "buy_price", "sell_price", "manufacturer_id"},
     *             @OA\Property (property="product_name", type="string", example="Farofa Zaeli"),
     *             @OA\Property (property="product_description", type="string", example="A melhor do mercado!"),
     *             @OA\Property (property="fabrication_date", type="string", format="date", example="2025-06-20"),
     *             @OA\Property (property="expiration_date", type="string", format="date", example="2026-06-20"),
     *             @OA\Property (property="buy_price", type="number", format="float", example=19.00),
     *             @OA\Property (property="sell_price", type="number", format="float", example=28.00),
     *             @OA\Property (property="manufacturer_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response (
     *         response="201",
     *         description="Produto criado com sucesso",
     *         @OA\JsonContent (
     *             @OA\Property (property="id", type="integer", example=1),
     *             @OA\Property (property="product_name", type="string", example="Farofa Zaeli"),
     *             @OA\Property (property="product_description", type="string", example="A melhor do mercado!"),
     *             @OA\Property (property="fabrication_date", type="string", format="date", example="2025-06-20"),
     *             @OA\Property (property="expiration_date", type="string", format="date", example="2026-06-20"),
     *             @OA\Property (property="buy_price", type="number", format="float", example=19.00),
     *             @OA\Property (property="sell_price", type="number", format="float", example=28.00),
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
            "product_name" => "required",
            "product_description" => "required",
            "fabrication_date" => "required",
            "expiration_date" => "required",
            "buy_price" => "required",
            "sell_price" => "required",
            "manufacturer_id" => "required||exists:manufacturers,id",
        ]);

        $products = new Products;
        $products->product_name = $request->input('product_name');
        $products->product_description = $request->input('product_description');
        $products->fabrication_date = $request->input('fabrication_date');
        $products->expiration_date = $request->input('expiration_date');
        $products->buy_price = $request->input('buy_price');
        $products->sell_price = $request->input('sell_price');
        $products->manufacturer_id = $request->input('manufacturer_id');
        $products->save();
        return Response()->json($products);
    }

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     summary="Buscar um produto",
     *     tags={"Produto"},
     *     @OA\Parameter (
     *         name="id",
     *         in="path",
     *         description="Id do produto",
     *         required=true,
     *         @OA\Schema (type="integer")
     *         ),
     *         @OA\Response (
     *          response="200",
     *          description="Aqui está o produto desejado",
     *          @OA\JsonContent (
     *              @OA\Property (property="id", type="integer", example=1),
     *              @OA\Property (property="product_name", type="string", example="Farofa Zaeli"),
     *              @OA\Property (property="product_description", type="string", example="A melhor do mercado!"),
     *              @OA\Property (property="fabrication_date", type="string", format="date", example="2025-06-20"),
     *              @OA\Property (property="expiration_date", type="string", format="date", example="2026-06-20"),
     *              @OA\Property (property="buy_price", type="number", format="float", example=19.00),
     *              @OA\Property (property="sell_price", type="number", format="float", example=28.00),
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
        $products = Products::with('manufacturer')->find($id);

        return Response()->json($products);
    }


    public function edit($id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/products/update/{id}",
     *     summary="Alterar um cadastro",
     *     tags={"Produto"},
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="Id do produto",
     *          required=true,
     *          @OA\Schema (type="integer")
     *          ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_name", "product_description", "sell_price", "buy_price"},
     *           @OA\Property (property="product_name", type="string", example="Farofa Zaeli"),
     *           @OA\Property (property="product_description", type="string", example="A melhor do mercado!"),
     *           @OA\Property (property="buy_price", type="number", format="float", example=19.00),
     *           @OA\Property (property="sell_price", type="number", format="float", example=28.00),
     *         )
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="Produto alterado com sucesso",
     *         @OA\JsonContent (
     *             @OA\Property (property="id", type="integer", example=1),
     *             @OA\Property (property="product_name", type="string", example="Farofa Pinduca"),
     *             @OA\Property (property="product_description", type="string", example="A mais saborosa."),
     *             @OA\Property (property="buy_price", type="number", format="float", example=32.00),
     *             @OA\Property (property="sell_price", type="number", format="float", example=48.00),
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
            "product_name" => "required",
            "product_description" => "required",
            "sell_price" => "required",
            "buy_price" => "required",
        ]);

        $products = Products::find($id);
        $products->product_name = $request->input('product_name');
        $products->product_description = $request->input('product_description');
        $products->buy_price = $request->input('buy_price');
        $products->sell_price = $request->input('sell_price');
        $products->save();
        return Response()->json($products);
    }


    /**
     * @OA\Delete(
     *     path="/products/delete/{id}",
     *     summary="Deletar um produto pelo ID",
     *     tags={"Produto"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto a ser deletado.",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Produto deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */

    public function destroy($id)
    {
        $products = Products::find($id);

        if (!$products) {
            return Response()->json(['message' => 'Product not found']);
        }

        $products->delete();
        return Response()->json($products);
    }
}
