<?php
use setasign\Fpdi;
require_once 'Fpdf/autoload.php';
require_once 'Fpdf/setasign/fpdf/fpdf.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(2);
$start = microtime(true);
include "db.php";


if(isset($_GET['id']))
{
    $selectLeaveApplicationQuery = mysqli_query($conn,"SELECT * FROM leave_application WHERE id='" .$_GET['id'] . "' ");
    $selectLeaveApplicationResult = mysqli_fetch_assoc($selectLeaveApplicationQuery);

    $formPdf = new FPDF();
    $formPdf->AddPage();

    $formPdf->SetFont('arial','',12);
    $formPdf->Cell(190,10,"Leave Application",1,0,'C');
    $formPdf->Ln();
    $formPdf->Cell(50,10,"Subject",1,0);
    $formPdf->Cell(140,10,$selectLeaveApplicationResult['subject'],1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"Leave Type",1,0);
    $formPdf->Cell(140,10,$selectLeaveApplicationResult['leave_type'],1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"Status",1,0);
    $formPdf->Cell(140,10,$selectLeaveApplicationResult['status'],1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"From Date",1,0);
    $formPdf->Cell(140,10,date("d-m-Y", strtotime($selectLeaveApplicationResult['from_date'])),1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"To Date",1,0);
    $formPdf->Cell(140,10,date("d-m-Y", strtotime($selectLeaveApplicationResult['to_date'])),1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"Leave Duration",1,0);
    $formPdf->Cell(140,10,$selectLeaveApplicationResult['leave_duration'],1,0);
    $formPdf->Ln();
    $formPdf->Cell(50,10,"No Of Days",1,0);
    $formPdf->Cell(140,10,$selectLeaveApplicationResult['no_of_days'],1,0);
    $formPdf->Ln();
    $formFile = 'uploads/tmp_form.pdf';
    $formPdf->output($formFile,'F');
    

    if($selectLeaveApplicationResult['doc_upload'] != '')
    {
        $fileDecode = base64_decode($selectLeaveApplicationResult['doc_upload']);
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
