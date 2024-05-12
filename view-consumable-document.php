<?php
include 'db.php';

$documentName = "";
$encodedDoc = "";

switch ($_GET['document']) 
{
    case "entry_in_stock_register":
        $documentName = "entry_in_stock_register_upload_name";
        $encodedDoc = "entry_in_stock_register_upload";
      break;
    case "installation_report":
        $documentName = "installation_report_name";
        $encodedDoc = "installation_report";
      break;
    case "amc_doc":
        $documentName = "amc_doc_name";
        $encodedDoc = "amc_doc";
      break;
    case "hardware_received_receipt":
        $documentName = "hardware_received_receipt_name";
        $encodedDoc = "hardware_received_receipt";
      break;
    case "hardware_invoice":
        $documentName = "hardware_invoice_upload_name";
        $encodedDoc = "hardware_invoice_upload";
      break;
    case "gem_document":
        $documentName = "gem_document_name";
        $encodedDoc = "gem_document";
      break;
    default:
        $documentName = "";
        $encodedDoc = "";
  }

$getDocumentQuery = "select $documentName, $encodedDoc from consumable_stock_items_uploads where item_id='$_GET[id]';";

$getDocument = mysqli_query($conn, $getDocumentQuery);

$row = mysqli_fetch_assoc($getDocument);

$extension = pathinfo($row[$documentName], PATHINFO_EXTENSION);

switch ($extension) 
{
    case "png":
        $src = 'image/png';
        break;
    case "pdf":
        $src = 'application/pdf';
        break;
    case "jpg":
        $src = 'image/jpg';
        break;
    case "jpeg":
        $src = 'image/jpeg';
        break;
    case "docx":
        $src = 'application/msword';
        break;
    case "doc":
        $src = 'application/msword';
        break;
    case "txt":
        $src = 'text/plain';
        break;
    default:
        $src = 'application';
}

if($row[$documentName] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Document Not attached</h1>";
}
else
{
  $data = base64_decode($row[$encodedDoc]);
  header('Content-Type: '.$src);
  header('Content-Disposition: inline; filename="' . $row[$documentName] . '"');
  echo $data;
}
?>
