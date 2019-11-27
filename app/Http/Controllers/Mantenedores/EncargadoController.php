<?php

namespace App\Http\Controllers\Mantenedores;

use App\Models\Encargado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EncargadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    function __construct()
    {
        $this->middleware('permission:encargado-list');
        $this->middleware('permission:encargado-create', ['only' => ['create', 'store']]);
    }

    public function index(){

        $encargados = Encargado::paginate(15);
        return view('mantenedores.encargados.index', ['encargados' => $encargados]);
    }

    public function create(){
        return view('mantenedores.encargados.create');
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'nombre' => 'required|max:100',
            'rut' => 'required|max:20|unique:encargados'
        ]);
        Encargado::create($validatedData);
        return redirect()->route('encargados.index')->with('status', 'Encargado creado exitosamente');

    }

}
