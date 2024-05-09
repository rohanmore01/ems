<?php
ob_start();
use setasign\Fpdi;
require_once 'Fpdf/autoload.php';
require_once 'Fpdf/setasign/fpdf/fpdf.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(2);
$start = microtime(true);

$data = array();
parse_str($_POST['data'], $data);

$formPdf = new FPDF();
$formPdf->AddPage();

$formPdf->SetFont('arial','',12);
$formPdf->Cell(190,10,"Leave Application",1,0,'C');
$formPdf->Ln();
$formPdf->Cell(50,10,"Subject",1,0);
$formPdf->Cell(140,10,$data['subject'],1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"Leave Type",1,0);
$formPdf->Cell(140,10,$data['leave_type'],1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"Status",1,0);
$formPdf->Cell(140,10,$data['status'],1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"From Date",1,0);
$formPdf->Cell(140,10,date("d-m-Y", strtotime($data['from_date'])),1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"To Date",1,0);
$formPdf->Cell(140,10,date("d-m-Y", strtotime($data['to_date'])),1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"Leave Duration",1,0);
$formPdf->Cell(140,10,$data['leave_duration'],1,0);
$formPdf->Ln();
$formPdf->Cell(50,10,"No Of Days",1,0);
$formPdf->Cell(140,10,$data['no_of_days'],1,0);
$formPdf->Ln();
$formFile = 'uploads/tmp_form.pdf';
$formPdf->output($formFile,'F');


if(isset($_FILES['doc_file']))
{
    $pdf = new Fpdi\Fpdi();

    $files = [
    'uploads/tmp_form.pdf',
    $_FILES['doc_file']['tmp_name'],
    ];

    foreach ($files as $file) {
        $pageCount = $pdf->setSourceFile($file);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $pdf->AddPage();
            $pageId = $pdf->importPage($pageNo, '/MediaBox');
            $s = $pdf->useTemplate($pageId, 10, 10, 200);
        }
    }
    $file = uniqid().'.pdf';
    $pdf->Output('I', $file);
}
else
{
    if(isset($_POST['action']) == 'edit' && $_POST['attachedFile'] != '')
    {
        $fileDecode = base64_decode($_POST['encodedFile']);
        file_put_contents('uploads/tmp_file.pdf',$fileDecode);

        $pdf = new Fpdi\Fpdi();

        $files = [
        'uploads/tmp_form.pdf',
        'uploads/tmp_file.pdf',
        ];

        foreach ($files as $file) {
            $pageCount = $pdf->setSourceFile($file);

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pdf->AddPage();
                $pageId = $pdf->importPage($pageNo, '/MediaBox');
                $s = $pdf->useTemplate($pageId, 10, 10, 200);
            }
        }
        $file = uniqid().'.pdf';
        $pdf->Output('I', $file);

    }
    else
    {
        $formPdf->output();
    }
}

?>