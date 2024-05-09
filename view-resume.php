<?php
include 'db.php';

$getEmployeeResumeQuery = "select resume_name, encoded_resume from employees where id='$_GET[id]';";

$getEmployeeResume = mysqli_query($conn, $getEmployeeResumeQuery);

$row = mysqli_fetch_assoc($getEmployeeResume);

$extension = pathinfo($row['resume_name'], PATHINFO_EXTENSION);

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

if($row['encoded_resume'] == "")
{
    echo "<h1 style='position:relative;top:155px;left:450px;'>Resume Not attached</h1>";
}
else
{
    $data = base64_decode($row['encoded_resume']);
    header('Content-Type: '.$src);
    header('Content-Disposition: inline; filename="' . $row['resume_name'] . '"');
    echo $data;
}
?>
