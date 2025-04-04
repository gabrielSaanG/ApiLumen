<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;

class ManufacturerController extends Controller
{

    public function index()
    {
        $manufacturer = Manufacturer::all();
        return Response()->json($manufacturer);
    }


    public function create()
    {

    }


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


    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);
        return Response()->json($manufacturer);
    }


    public function edit($id)
    {
        //
    }


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


    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        return Response()->json($manufacturer);
    }
}
