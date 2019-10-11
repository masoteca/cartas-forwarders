<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DataService;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class PrintsController extends Controller
{
    protected $dataService;

    /**
     * Create a new controller instance.
     *
     * HomeController constructor.
     * @param DataService $dataService
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
        $this->middleware('auth');
    }

    public function printcarta(Request $request,  $id)
    {
        $model = Document::find($id);
        $compania = strtolower(trim($model->airline()->first()->name));
        $compania = 'aeromexico';
        $path = storage_path("app/pdf/{$compania}/carta1.pdf");
        $pdf = new Fpdi();
        $pdf->setSourceFile($path);
        $tplId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($tplId, ['adjustPageSize' => true]);
        $pdf->SetFont('Helvetica');
        $pdf->Output('I', "carta_{$model->awb}.pdf");
    }

}
