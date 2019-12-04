<?php

namespace App\Http\Controllers\Mantenedores;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    function __construct()
    {
        $this->middleware('permission:destino-list');
        $this->middleware('permission:destino-create', ['only' => ['create', 'store']]);
    }

    public function index()
    {

        $destinos = Destination::paginate(15);
        return view('mantenedores.destinos.index', ['destinos' => $destinos]);
    }

    public function create()
    {
        return view('mantenedores.destinos.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'country' => 'required|max:100|unique:destinations',
            'code' => 'required|max:5|unique:destinations'
        ]);
        Destination::create($validatedData);
        return redirect()->route('destinos.index')->with('status', 'Destination creado exitosamente');

    }
}
