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
        $this->middleware('permission:destino-edit', ['only' => ['update', 'edit']]);
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

    public function edit($id)
    {
        $destino = Destination::find($id);
        return view('mantenedores.destinos.edit', ['destino' => $destino]);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'country' => 'required|max:100|unique:destinations',
            'code' => 'required|max:5|unique:destinations'
        ]);

        $destino = Destination::find($id);
        $destino->update($validatedData);
        $destino->save();
        return redirect()->route('destinos.index')->with('status', 'Destination actualizado exitosamente');
    }
}
