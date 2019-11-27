<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    function __construct()
    {
        $this->middleware('permission:producto-list');
        $this->middleware('permission:producto-create', ['only' => ['create', 'store']]);
    }

    public function index(){

        $productos = Product::paginate(15);
        return view('mantenedores.productos.index', ['productos' => $productos]);
    }

    public function create(){
        return view('mantenedores.productos.create');
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:100',
        ]);
        Product::create($validatedData);
        return redirect()->route('productos.index')->with('status', 'Producto creado exitosamente');

    }

}
