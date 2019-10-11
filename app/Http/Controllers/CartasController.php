<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Document;

class CartasController extends Controller
{
    public function store(Request $request)
    {
        $destino = Destination::whereCode($request->destination)->first();
        $airline = Airline::wherePrefix($request->airline)->first();

        $model = Document::create([
            'awb' => $request->awb,
            'id_destination' => $destino->id,
            'iata_code' => $request->iata_code,
            'fecha_envio' => $request->fecha_envio,
            'id_product' => $request->product,
            'id_airline' => $airline->id,
            'encargado' => $request->encargado
        ]);
        return response()->json(['carta' => $model], 201);
    }

}
