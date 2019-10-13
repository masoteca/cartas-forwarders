<?php


namespace App\Services;


class PdfEditorService
{

    public function addnewpagefromsamefile($pdf, $path, $page)
    {
        $pdf->setSourceFile($path);
        $tplId = $pdf->importPage($page);
        $pdf->AddPage();
        $pdf->useTemplate($tplId, ['adjustPageSize' => true]);
    }

}
