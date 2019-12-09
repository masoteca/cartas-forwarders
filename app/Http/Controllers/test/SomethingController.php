<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use JasperPHP\JasperPHP as JasperPHP;

class SomethingController extends Controller
{
    //...

    public function generateReport()
    {

        /*
        $jasper = new JasperPHP;
        // Compilar el reporte para generar .jasper
        $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/hello_world.jrxml')->execute();
        return view('welcome');
        */

        $jasper = new JasperPHP;
        $path = storage_path('app/reportes/reporte');

        $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
            base_path() . '/vendor/cossou/jasperphp/examples/hello_world.jasper',
            $path,
            // Ruta y nombre de archivo de salida del reporte (sin extensión)
            array('pdf', 'rtf'), // Formatos de salida del reporte
            array('php_version' => phpversion()) // Parámetros del reporte
        )->execute();

        return \Response::download($path . '.pdf');
    }
}
