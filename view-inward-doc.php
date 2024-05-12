<?php
include 'db.php';

$getInwardDocQuery = "select upload_name, upload from inwards where id='$_GET[id]';";

$getInwardDoc = mysqli_query($conn, $getInwardDocQuery);

$row = mysqli_fetch_assoc($getInwardDoc);

$extension = pathinfo($row['upload_name'], PATHINFO_EXTENSION);

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

if($row['upload'] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Document not Uploaded</h1>";
}
else
{
    $data = base64_decode($row['upload']);
    header('Content-Type: '.$src);
    header('Content-Disposition: inline; filename="' . $row['upload_name'] . '"');
    echo $data;
}
?>