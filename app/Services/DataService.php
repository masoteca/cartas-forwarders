<?php


namespace App\Services;

use App\Models\Document;
use App\Models\Encargado;
use App\User;
use App\Models\Destination;
use App\Models\Product;
use App\Models\Airline;
use Auth;
use Carbon\Carbon;

class DataService
{

    public function getProducts()
    {
        return Product::pluck('name', 'id');
    }

    public function getAirlines()
    {
        return Airline::pluck('name', 'prefix');
    }

    public function getDestinations()
    {
        return Destination::pluck('country', 'code');
    }

    public function cartas_usuario()
    {
        //whereEncargado(Auth::user()->name)
        $cartas = Document::with(['destination', 'product', 'airline'])->orderBy('fecha_envio')->whereBetween('fecha_envio', [Carbon::today()->format('y-m-d'), Carbon::now()->addDays(7)->format('y-m-d'),])->get();
        return $cartas->groupBy('fecha_envio');
    }

    public function getEncargados()
    {
        return Encargado::pluck('nombre', 'rut');
    }


    public function getFormData()
    {
        return [
            'cartas' => $this->cartas_usuario(),
            'airlines' => $this->getAirlines(),
            'destinations' => $this->getDestinations(),
            'products' => $this->getProducts(),
            'encargados' => $this->getEncargados()
        ];
    }
}
