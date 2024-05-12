<?php
include "header.php";

$deleteProject = mysqli_query($conn, "DELETE FROM `projects` WHERE id = '".$_GET['id']."'");

$deleteProjectNotes = mysqli_query($conn, "DELETE FROM `project_notes` WHERE project_id = '".$_GET['id']."'");

if($deleteProject == 1 && $deleteProjectNotes == 1)
{
    $_SESSION["message"] = "Project Deleted Successfully";
    header('Location: '.'projects.php');
}
else
{
    $message = "Unable to Delete Project Data";
    echo $message;
}
?>