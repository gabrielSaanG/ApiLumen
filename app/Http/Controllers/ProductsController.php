<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductsController extends Controller
{

    public function index()
    {
        $products = Products::all();
        return Response()->json($products);
    }


    public function create()
    {
        //
    }


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
        $products->product_description = $request->input('production_description');
        $products->fabrication_date = $request->input('fabrication_date');
        $products->expiration_date = $request->input('expiration_date');
        $products->buy_price = $request->input('buy_price');
        $products->sell_price = $request->input('sell_price');
        $products->manufacturer_id = $request->input('manufacturer_id');
        $products->save();
        return Response()->json($products);
    }

    public function show($id)
    {
        $products = Products::find($id);
        return Response()->json($products);
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();
        return Response()->json($products);
    }
}
