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
        $compania = strtolower(trim($model->airline()->first()->name));
        $compania = 'aeromexico';
        $path = storage_path("app/pdf/{$compania}/cartas.pdf");
        $pdf = new Fpdi();
        $pdf->setSourceFile($path);
        $tplId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($tplId, ['adjustPageSize' => true]);
        $pdf->SetFont('Helvetica');

        //switch case
        switch ($compania) {
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
                $pdf->Write(12, "{$model->encargado}");

                $this->editorService->addnewpagefromsamefile($pdf, $path, 3);
                $pdf->SetXY(55, 68);
                $pdf->Write(12, "{$model->awb} ");
                break;
            default:
                break;

        }


        $pdf->Output('I', "carta_{$model->awb}.pdf");
    }

}
