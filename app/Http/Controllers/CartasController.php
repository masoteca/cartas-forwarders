<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Destination;
use App\Services\DataService;
use Illuminate\Http\Request;
use App\Models\Document;

class CartasController extends Controller
{
    public $dataService;

    public function __construct(DataService $service)
    {
        $this->dataService = $service;
    }

    public function index(Request $request)
    {
        $data = $this->dataService->getFormData();
        $data['cartas'] = Document::all();

        return view('cartas.lista', $data);
    }

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
            'rut_encargado' => $request->encargado
        ]);
        return response()->json(['carta' => $model], 201);
    }

    public function edit(Document $document)
    {
        $data = $this->dataService->getFormData();
        $data ['documento'] = $document;
        return view('cartas.edit', $data);
    }

    public function update(Request $request, Document $document)
    {
        $airline = Airline::wherePrefix($request->airline)->first();
        $destino = Destination::whereCode($request->destination)->first();
        $document->awb = $request->awb;
        $document->id_airline = $airline->id;
        $document->id_destination = $destino->id;
        $document->id_product = $request->product;
        $document->rut_encargado = $request->encargado;
        $document->update($request->all());

        return redirect()->route('document.index')->withStatus(__('Documento Actualizado Correctamente'));

    }

    /**
     * Remove the specified user from storage
     *
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('document.index')->withStatus(__('Document successfully deleted.'));
    }
}
