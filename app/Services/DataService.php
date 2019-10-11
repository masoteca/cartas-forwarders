<?php


namespace App\Services;

use App\User;
use App\Models\Destination;
use App\Models\Product;
use App\Models\Airline;

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

    public function getFormData()
    {
        return [
            'airlines' => $this->getAirlines(),
            'destinations' => $this->getDestinations(),
            'products' => $this->getProducts(),
        ];
    }
}
