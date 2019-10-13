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
        $aerolinea = 'air canada';
        $path = resource_path("pdf/{$aerolinea}/cartas.pdf");
        $pdf = new Fpdi();
        $pdf->SetFont('Helvetica');
        $this->editorService->addnewpagefromsamefile($pdf, $path, 1);

        //switch case
        switch ($aerolinea) {
            case 'aeromexico':

                $pdf->SetXY(100, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb} ");
                $pdf->SetXY(50, 75);
                $pdf->Write(12, "{$model->product->name} ");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$model->destination->code} ");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(55, 68);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(55, 78);
                $pdf->Write(12, "{$model->destination->country}");
                $pdf->SetXY(65, 145);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(65, 155);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(65, 248);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(65, 258);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(45, 177);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(65, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(45, 225);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(45, 45);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(140, 55);
                $pdf->Write(12, "{$model->destination->country}");
                $pdf->SetXY(60, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 253);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");
                break;
            case 'air new zeland':
                $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$model->product->name}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$model->destination->code}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetFontSize(14);
                $pdf->SetXY(53, 45);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 55);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(60, 128);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 138);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 232);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 242);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(45, 128);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 148);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(84, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(70, 41);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(170, 41);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(45, 210);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(62, 67);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 67);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(67, 164);
                $pdf->Write(12, "{$model->fecha_envio}");
                break;
            case 'air canada':
                $pdf->SetXY(110, 58);
                $pdf->SetFontSize(18);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(75, 75);
                $pdf->Write(12, "{$model->product->name}");
                $pdf->SetXY(80, 100);
                $pdf->Write(12, "{$model->destination->code}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 2);
                $pdf->SetXY(85, 65);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(50, 77);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(82, 100);
                $pdf->SetFontSize(14);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 210);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(53, 67);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(53, 78);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(60, 147);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 157);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 247);
                $pdf->Write(12, "{$model->encargado->nombre}");
                $pdf->SetXY(60, 257);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 4);
                $pdf->SetXY(45, 177);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 187);
                $pdf->Write(12, "{$model->awb}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 5);
                $pdf->SetXY(62, 60);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(150, 60);
                $pdf->Write(12, "{$model->destination->country} {$model->destination->code}");
                $pdf->SetXY(50, 220);
                $pdf->Write(12, "{$model->fecha_envio}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 6);
                $pdf->SetXY(40, 55);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(150, 65);
                $pdf->Write(12, "{$model->destination->country}");
                $pdf->SetXY(52, 75);
                $pdf->Write(12, "{$model->awb}");
                $pdf->SetXY(160, 260);
                $pdf->Write(12, "{$model->fecha_envio}");
                $this->editorService->addnewpagefromsamefile($pdf, $path, 7);
                $pdf->SetXY(45, 135);
                $pdf->Write(12, "{$model->fecha_envio}");
                $pdf->SetXY(60, 155);
                $pdf->Write(12, "{$model->awb}");
                break;
            default:
                break;

        }


        $pdf->Output('I', "carta_{$model->awb}.pdf");
    }

}
