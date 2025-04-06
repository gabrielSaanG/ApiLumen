<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;


class ManufacturerController extends Controller
{

    /**
     * @OA\Get(
     *     path="/manufacturers",
     *     summary="Buscar todos os fabricantes no banco.",
     *     tags={"Fabricante"},
     *     @OA\Response (response="200", description="test")
     * )
     *
     */

    public function index()
    {
        $manufacturer = Manufacturer::all();
        return Response()->json($manufacturer);
    }


    public function create()
    {

    }

    /**
     * @OA\Post(
     *     path="/manufacturers/create",
     *     summary="Cadastrar novo fabricante",
     *     tags={"Fabricante"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"manufacturer_name", "manufacturer_social_name", "cnpj"},
     *             @OA\Property (property="manufacturer_name", type="string", example="Zaeli"),
     *             @OA\Property (property="manufacturer_social_name", type="string", example="Zaeli ltda."),
     *             @OA\Property (property="cnpj", type="string", example="01.001.001/00001-30"),
     *         )
     *     ),
     *     @OA\Response (
     *         response="201",
     *         description="Fabricante criado com sucesso",
     *         @OA\JsonContent (
     *             @OA\Property (property="id", type="integer", example=1),
     *             @OA\Property (property="manufacturer_name", type="string", example="Zaeli"),
     *             @OA\Property (property="manufacturer_social_name", type="string", example="Zaeli ltda."),
     *             @OA\Property (property="cnpj", type="string", example="01.001.001/00001-30"),
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
            "manufacturer_name" => "required",
            "manufacturer_social_name" => "required",
            "cnpj"=>"required",
        ]);

        $manufacturer = new Manufacturer;
        $manufacturer->manufacturer_name = $request->input('manufacturer_name');
        $manufacturer->manufacturer_social_name = $request->input('manufacturer_social_name');
        $manufacturer->cnpj = $request->input('cnpj');
        $manufacturer->save();
        return Response()->json($manufacturer);
    }


    /**
     * @OA\Get(
     *     path="/manufacturers/{id}",
     *     summary="Buscar um fabricante",
     *     tags={"Fabricante"},
     *     @OA\Parameter (
     *         name="id",
     *         in="path",
     *         description="Id do fabricante",
     *         required=true,
     *         @OA\Schema (type="integer")
     *         ),
     *         @OA\Response (
     *          response="200",
     *          description="Aqui está o fabricante desejado",
     *          @OA\JsonContent (
     *              @OA\Property (property="id", type="integer", example=1),
     *              @OA\Property (property="manufacturer_name", type="string", example="Zaeli"),
     *              @OA\Property (property="manufacturer_social_name", type="string", example="Zaeli ltda."),
     *              @OA\Property (property="cnpj", type="string", example="01.001.001/00001-30"),
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
        $manufacturer = Manufacturer::find($id);
        return Response()->json($manufacturer);
    }


    public function edit($id)
    {
        //
    }


    /**
     * @OA\Put(
     *     path="/manufacturers/update/{id}",
     *     summary="Alterar um cadastro",
     *     tags={"Fabricante"},
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="Id do fabricante",
     *          required=true,
     *          @OA\Schema (type="integer")
     *          ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"manufacturer_name", "manufacturer_social_name", "cnpj"},
     *             @OA\Property (property="manufacturer_name", type="string", example="Zaeli"),
     *             @OA\Property (property="manufacturer_social_name", type="string", example="Zaeli ltda."),
     *             @OA\Property (property="cnpj", type="string", example="01.001.001/00001-30"),
     *         )
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="Fabricante alterado com sucesso",
     *         @OA\JsonContent (
     *             @OA\Property (property="id", type="integer", example=1),
     *             @OA\Property (property="manufacturer_name", type="string", example="Zaeli"),
     *             @OA\Property (property="manufacturer_social_name", type="string", example="Zaeli ltda."),
     *             @OA\Property (property="cnpj", type="string", example="01.001.001/00001-30"),
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
            "manufacturer_name" => "required",
            "manufacturer_social_name" => "required",
            "cnpj"=>"required",
        ]);

        $manufacturer = Manufacturer::find($id);
        $manufacturer->manufacturer_name = $request->input('manufacturer_name');
        $manufacturer->manufacturer_social_name = $request->input('manufacturer_social_name');
        $manufacturer->cnpj = $request->input('cnpj');
        $manufacturer->save();
        return Response()->json($manufacturer);
    }

    /**
     * @OA\Delete(
     *     path="/manufacturers/delete/{id}",
     *     summary="Deletar um fabricante pelo ID",
     *     tags={"Fabricante"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do fabricante a ser deletado. OBS: Se o fabricante tiver algum produto no sistema,
               A deleção não será possível.",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Fabricante deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Fabricante não encontrado"
     *     )
     * )
     */

    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return Response()->json(['message' => 'Manufacturer not found']);
        }

        $manufacturer->delete();
        return Response()->json($manufacturer);
    }
}
