<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class EtiquetasController extends Controller
{
    //
    public function print($id){

        $envio = Document::find($id);

        return view('etiquetas.etiquetas',['carta' => $envio]);

    }
}
