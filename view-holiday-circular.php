<?php
include 'db.php';

$getHolidayCircularQuery = "select document_name, encoded_document from holiday_master where id='$_GET[id]';";

$getHolidayCircular = mysqli_query($conn, $getHolidayCircularQuery);

$row = mysqli_fetch_assoc($getHolidayCircular);

$extension = pathinfo($row['document_name'], PATHINFO_EXTENSION);

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

if($row['encoded_document'] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Document not Uploaded</h1>";
}
else
{
    $data = base64_decode($row['encoded_document']);
    header('Content-Type: '.$src);
    header('Content-Disposition: inline; filename="' . $row['document_name'] . '"');
    echo $data;
}
?>