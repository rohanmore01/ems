<?php
include 'db.php';

$getWorkOrderDocQuery = "select document, doc_name from work_orders where id='$_GET[id]';";

$getWorkOrderDoc = mysqli_query($conn, $getWorkOrderDocQuery);

$row = mysqli_fetch_assoc($getWorkOrderDoc);

$extension = pathinfo($row['doc_name'], PATHINFO_EXTENSION);

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

if($row['document'] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Document not Uploaded</h1>";
}
else
{
    $data = base64_decode($row['document']);
    header('Content-Type: '.$src);
    header('Content-Disposition: inline; filename="' . $row['doc_name'] . '"');
    echo $data;
}
?>