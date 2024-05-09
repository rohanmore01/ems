<?php
include "header.php";

$deleteProjectNote = mysqli_query($conn, "DELETE FROM `project_notes` WHERE id = '".$_GET['id']."'");

if($deleteProjectNote == 1)
{
    $_SESSION["message"] = "Project Note Deleted Successfully";
    header('Location: '.'project-details.php?id='.$_GET["project_id"]);
}
else
{
    $message = "Unable to Delete Project Note Data";
    echo $message;
}
?>