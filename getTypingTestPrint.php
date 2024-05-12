<?php
use setasign\Fpdi;
require_once 'Fpdf/autoload.php';
require_once 'Fpdf/setasign/fpdf/fpdf.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(2);
$start = microtime(true);
include "db.php";


if($_GET['gross_speed'] != '')
{
    $grossSpeedQuery = " AND `gross_speed` " .$_GET['gross_speed_condition']. " '" .$_GET['gross_speed'] . "'";
}
else
{
    $grossSpeedQuery = " ";
}

if($_GET['net_speed'] != '')
{
    $netSpeedQuery = " AND `net_speed` " .$_GET['net_speed_condition']. " '" .$_GET['net_speed'] . "'";
}
else
{
    $netSpeedQuery = " ";
}

if($_GET['accuracy'] != '')
{
    $accuracyQuery = " AND `accuracy` " .$_GET['accuracy_condition']. " '" .$_GET['accuracy'] . "'";
}
else
{
    $accuracyQuery = " ";
}

$selectTypingTests = mysqli_query($conn,"SELECT * FROM `typing_test` WHERE `department_id` = '" .$_GET['department_id'] . "'   $grossSpeedQuery  $netSpeedQuery  $accuracyQuery");

$selectDepartment = mysqli_query($conn,"SELECT department, date FROM `typing_master` WHERE `id` = '" .$_GET['department_id'] . "'");
$selectDepartment = mysqli_fetch_assoc($selectDepartment);

$formPdf = new FPDF();
$formPdf->AddPage();

$formPdf->SetFont('arial','',12);
$formPdf->SetTextColor(194,8,8);
$formPdf->Cell(194,10,"TYPING TEST RESULT",0,0,'C');
$formPdf->SetDrawColor(188,188,188);
$formPdf->Ln();
$formPdf->SetTextColor(0,0,255);
$formPdf->Cell(194,10,"Date : ".date("d-m-Y", strtotime($selectDepartment['date'])),0,0,'R');
$formPdf->Cell(-147,10,"Department : ".$selectDepartment['department'],0,0,'R');
$formPdf->Ln();
$formPdf->SetTextColor(0,0,0);
$formPdf->Cell(14,7,"Sr No.",1,0);
$formPdf->Cell(27,7,"Roll No.",1,0);
$formPdf->Cell(54,7,"Name",1,0);
$formPdf->Cell(30,7,'Contact No.',1,0);
$formPdf->Cell(27,7,'Gross Speed',1,0);
$formPdf->Cell(22,7,'Net Speed',1,0);
$formPdf->Cell(20,7,'Accuracy',1,0);

$i=1;
while($selectTypingTest = mysqli_fetch_assoc($selectTypingTests))
{
    $formPdf->Ln();
    $formPdf->Cell(14,7,$i,1,0);
    $formPdf->Cell(27,7,$selectTypingTest['roll_no'],1,0);
    $formPdf->Cell(54,7,$selectTypingTest['name'],1,0);
    $formPdf->Cell(30,7,$selectTypingTest['mobile_no'],1,0);
    $formPdf->Cell(27,7,$selectTypingTest['gross_speed'],1,0);
    $formPdf->Cell(22,7,$selectTypingTest['net_speed'],1,0);
    $formPdf->Cell(20,7,$selectTypingTest['accuracy'],1,0);
    $i++;
}

$formPdf->output();

?>