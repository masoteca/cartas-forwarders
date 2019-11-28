<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DataService;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Services\PdfEditorService;

class PrintsController extends Controller
{
    protected $dataService;
    protected $editorService;


    /**
     * Create a new controller instance.
     *
     * HomeController constructor.
     * @param DataService $dataService
     * @param PdfEditorService $editorService
     */
    public function __construct(DataService $dataService, PdfEditorService $editorService)
    {
        $this->editorService = $editorService;
        $this->dataService = $dataService;
        $this->middleware('auth');
    }

    public function printcarta(Request $request, $id)
    {
        $model = Document::find($id);
        $aerolinea = strtolower(trim($model->airline()->first()->name));
        $path = resource_path("pdf/{$aerolinea}/cartas.pdf");
        $pdf = new Fpdi();
        $pdf->SetFont('Helvetica');
        $this->editorService->addnewpagefromsamefile($pdf, resource_path("pdf/anexoh.pdf"), 1);
        $fechaEnvio = date('d/m/Y' , strtotime($model->fecha_envio));
        $encargado = iconv('UTF-8', 'windows-1252', $model->encargado->nombre);
        $producto = iconv('UTF-8', 'windows-1252', $model->product->name);
        $iata = $model->destination->code;
        $pais = iconv('UTF-8', 'windows-1252', $model->destination->country);


        //Escribir informacion de anexo H
        $pdf->SetXY(110, 45);
        $pdf->SetFontSize(18);
        $pdf->Write(12, "{$model->awb} ");
        $pdf->SetFont('Helvetica','B',18);
        $pdf->SetXY(65, 60);
        $pdf->Write(12, " {$producto} ");

        $pdf->SetXY(73, 83);
        $pdf->Write(12, " {$iata} ");
        $pdf->SetFont('Helvetica','',18);
        //switch case
        switch ($aerolinea) {
            case 'aeromexico':
/*
                $pdf->SetXY(100, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb} ");
                $pdf->SetXY(50, 75);
                $pdf->Write(12, "{$producto} ");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata} ");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(55, 68);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(55, 78);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(65, 145);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(65, 155);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(65, 248);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(65, 258);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(45, 177);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(65, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(45, 225);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(45, 45);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(140, 55);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(60, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 253);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");
                break;
            case 'air new zeland':
              /*  $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(53, 45);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 55);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(60, 128);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 138);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 232);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 242);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(84, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(70, 41);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(170, 41);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(45, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(62, 67);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 67);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(67, 164);
                $pdf->Write(12, "{$fechaEnvio}");
                break;
            case 'air canada':
             /*   $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(53, 67);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 78);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(60, 147);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 157);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 247);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 257);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(45, 177);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(50, 220);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 55);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(150, 65);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(52, 75);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 260);
                $pdf->Write(12, "{$fechaEnvio}");
                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(45, 135);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 155);
                $pdf->Write(12, "{$model->awb}");
                break;
            case 'british':

            /*    $pdf->SetXY(100, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb} ");
                $pdf->SetXY(50, 75);
                $pdf->Write(12, "{$producto} ");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata} ");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(65, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(85, 158);
                $pdf->Write(12, "{$encargado}");
                break;
            case 'cathay':

             /*   $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(58, 186);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 195);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 157);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(57, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(162, 53.5);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(40, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 62.5);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(60, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 145.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetFontSize(13);
                $pdf->SetXY(80, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 211);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'emirates':
/*
                $pdf->SetXY(100, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb} ");
                $pdf->SetXY(50, 75);
                $pdf->Write(12, "{$producto} ");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata} ");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(90, 99.5);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 204.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 62.5);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(60, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 145.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(57, 61);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(57, 69);
                $pdf->Write(12, "{$pais} {$iata}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(57, 47.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(166, 47.3);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(40, 212.4);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 133.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetFontSize(13);
                $pdf->SetXY(60, 152.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 162.5);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                /**Preguntar a roberto**/

                break;
            case 'alitalia':
            /*    $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(40, 59);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(40, 74);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(50, 138);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 148);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(50, 235);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 250);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(65, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 247);

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(61, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(157, 53);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(45, 216);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(150, 63);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(64, 63);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 167);
                $pdf->Write(12, "{$fechaEnvio}");

                break;
            case 'atlas':
            /*    $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$iata}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(40, 42);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(40, 53);
                $pdf->Write(12, "{$pais} {$iata}");
                $pdf->SetXY(50, 116);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 126);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(50, 213);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 223);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(60, 106);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 106);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(60, 236);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(45, 68);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 238);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(168, 60);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(64, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(55, 211);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(42, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                break;
            default:
                return "<h2> Error</h2> <br> <p>Servicio No Disponible";
                break;
        }

        $pdf->Output('I', "carta{$model->awb}.pdf");
    }

}
