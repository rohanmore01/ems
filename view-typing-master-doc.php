<?php
include 'db.php';

$getTypingMasterDocQuery = "select encoded_file, file_name from typing_master where id='$_GET[id]';";

$getTypingMasterDoc = mysqli_query($conn, $getTypingMasterDocQuery);

$row = mysqli_fetch_assoc($getTypingMasterDoc);

$extension = pathinfo($row['file_name'], PATHINFO_EXTENSION);

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
    case "csv":
        $src = 'text/csv';
        break;
    default:
        $src = 'application';
}

if($row['encoded_file'] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Document Not attached</h1>";
}
else
{
    $data = base64_decode($row['encoded_file']);
    header('Content-Type: '.$src);
    header('Content-Disposition: inline; filename="' . $row['file_name'] . '"');
    echo $data;
}
?>
