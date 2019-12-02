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
        $fechaEnvio = date('d/m/Y', strtotime($model->fecha_envio));
        $encargado = iconv('UTF-8', 'windows-1252', $model->encargado->nombre);
        $rutEncargado = iconv('UTF-8', 'windows-1252', $model->encargado->rut);
        $producto = iconv('UTF-8', 'windows-1252', $model->product->name);
        $iata = $model->destination->code;
        $pais = iconv('UTF-8', 'windows-1252', $model->destination->country);

        //Escribir informacion de anexo H
        $pdf->SetXY(110, 45);
        $pdf->SetFontSize(18);
        $pdf->Write(12, "{$model->awb} ");
        $pdf->SetFont('Helvetica', 'B', 18);
        $pdf->SetXY(65, 60);
        $pdf->Write(12, " {$producto} ");
        $pdf->SetXY(73, 83);
        $pdf->Write(12, " {$iata} ");
        $pdf->SetFont('Helvetica', '', 18);

        //switch case por aerolinea
        switch ($aerolinea) {

            case 'aeromexico':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(85, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 76.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(84, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(48, 211);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 67.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 77.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(60, 145.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 155.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 248);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 258);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 206);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 60.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 224);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 46);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(142, 55.5);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(54, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(58, 74);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(98, 228);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(98, 248);
                $pdf->Write(12, "{$rutEncargado}");
                $pdf->SetXY(160, 253);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(40, 128.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 157.5);
                $pdf->Write(12, "{$encargado}");
                break;

            case 'air new zeland':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(53, 45);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 55);
                $pdf->Write(12, "{$pais} ({$iata})");
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
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(70, 41);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(170, 41);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(45, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(62, 67);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 67);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(67, 164);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'air canada':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(85, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 76.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(84, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(48, 211);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 67.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 77.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(60, 145.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 155.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 248);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 258);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 206);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 60.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 219);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 55.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(150, 64.5);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(54, 74);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(58, 83.5);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(98, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(98, 258);
                $pdf->Write(12, "{$rutEncargado}");
                $pdf->SetXY(160, 262);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(40, 135.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 155.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 165);
                $pdf->Write(12, "{$encargado}");
                break;

            case 'british':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
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
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 62.5);
                $pdf->Write(12, "{$pais} ({$iata})");
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
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 211);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'emirates':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(85, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(90, 99.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 204.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 62.5);
                $pdf->Write(12, "{$pais} ({$iata})");
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
                $pdf->Write(12, "{$pais} ({$iata})");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(57, 47.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(166, 47.3);
                $pdf->Write(12, "{$pais} ({$iata})");
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

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(35, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(35, 75);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 138);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(40, 148);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(40, 235);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(40, 250);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(65, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 158);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 211);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(58, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(156, 53.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 216.5);
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

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(82, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 76.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 99.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(14);
                $pdf->SetXY(35, 42);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(35, 53);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 116);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(40, 126);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(40, 213);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(40, 223);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(50, 106.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 106.5);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(62, 237);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(45, 68);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 238);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetFontSize(14);
                $pdf->SetXY(168, 60);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(64, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(55, 211.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(42, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 158);
                $pdf->Write(12, "{$encargado}");
                break;

            case 'etihad':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(80, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.8);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 145);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(60, 59);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(60, 68);
                $pdf->Write(12, "{$pais}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(60, 47);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(145, 47);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(42, 210);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(65, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(157, 65);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(50, 163);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(43, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                break;

            case 'iberia':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(80, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.8);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 145);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(58, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(158, 53.4);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 211.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(43, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 157.5);
                $pdf->Write(12, "{$encargado}");
                break;

            case 'lufthansa':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(84, 88);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 199.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(18);
                $pdf->SetXY(120, 40);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 65);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(80, 90);
                $pdf->Write(12, "{$iata}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(54, 59);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(56, 73.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 176);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(30, 117);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(49, 203);
                $pdf->Write(12, "{$model->awb}");


                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(30, 107);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(49, 193);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(60, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(135, 53.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'korean':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(40, 37.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(143, 47);
                $pdf->Write(12, "((({$pais} ({$iata}))))");
                $pdf->SetXY(53, 56.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(58, 66);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(98, 220);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(98, 240);
                $pdf->Write(12, "{$rutEncargado}");
                $pdf->SetXY(158, 244);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(40, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 152.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 162.5);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(56, 40.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(157, 40.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 203.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 130.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 141);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 233);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 243);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetFontSize(14);
                $pdf->SetXY(84, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(52, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(84, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(50, 210.8);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'klm':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(80, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.8);
                $pdf->Write(12, "{$fechaEnvio}");

                /*                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(142, 61.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 185);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(140, 185);
                $pdf->Write(12, "{$fechaEnvio}");*/

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(53, 131);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(53, 140);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 228);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 238);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(58, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(155, 53.4);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(43, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 157.5);
                $pdf->Write(12, "{$encargado}");
                break;

            case 'gol airline':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(82, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(52, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 62.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 131);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 141);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 233);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 243);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(56, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(155, 53.5);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(42, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(40, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");

                break;

            case 'latam':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(40, 135);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 155);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(44, 143.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(44, 151);
                $pdf->Write(12, "{$pais} ({$iata})");

                break;

            case 'mercury':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 145);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(43, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 157.5);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetFontSize(14);
                $pdf->SetXY(80, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(45, 77);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(82, 100);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(45, 210.8);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetFontSize(12);
                $pdf->SetXY(60, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(145, 53.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(42, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");
                break;

            case 'qantas':
                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 53);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 63);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(58, 135.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 145);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(58, 238);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(58, 248);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(58, 53.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(163, 53.5);
                $pdf->Write(12, "({$pais})");
                $pdf->SetXY(42, 216.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(43, 128);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(82, 158);
                $pdf->Write(12, "{$encargado}");

                break;

            case 'ethiopian airlines':

                $this->editorService->addnewpagefromsamefile($pdf, $path, 1);
                $pdf->SetFontSize(14);
                $pdf->SetXY(85, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 76.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(48, 211);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 67.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 82.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(60, 155.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 165.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 258);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 268);
                $pdf->Write(12, "{$fechaEnvio}");


                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 206);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 206);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 60.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 224);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(62, 60.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 224);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(40, 37.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(142, 47);
                $pdf->Write(12, "{$pais}");
                $pdf->SetXY(54, 56);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(58, 65.5);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(98, 218);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(98, 238);
                $pdf->Write(12, "{$rutEncargado}");
                $pdf->SetXY(160, 244);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 8);
                $pdf->SetXY(40, 128.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 162.5);
                $pdf->Write(12, "{$encargado}");
                break;

            case "avianca":

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(12);
                $pdf->SetXY(90, 65.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 75.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(60, 210.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetFontSize(12);
                $pdf->SetXY(53, 67.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 77.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(60, 145.5);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 155.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 248);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(60, 258);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(40, 177.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(80, 206);
                $pdf->Write(12, "{$encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 54.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 54.5);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(40, 217);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 42.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(142, 52);
                $pdf->Write(12, "{$pais} ({$iata})");
                $pdf->SetXY(54, 62);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(58, 71.5);
                $pdf->Write(12, "{$producto}");
                $pdf->SetXY(98, 223);
                $pdf->Write(12, "{$encargado}");
                $pdf->SetXY(98, 242);
                $pdf->Write(12, "{$rutEncargado}");
                $pdf->SetXY(160, 246.5);
                $pdf->Write(12, "{$fechaEnvio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(40, 128.5);
                $pdf->Write(12, "{$fechaEnvio}");
                $pdf->SetXY(62, 147.5);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(81, 157.5);
                $pdf->Write(12, "{$encargado}");


                break;
            default:
                return "<h2>Error</h2> <br> <p>Servicio No disponible</p>";
                break;
        }

        $pdf->Output('I', "carta{$model->awb}.pdf");
    }

}
