<?php
include "header.php";

$deleteTypingMaster = mysqli_query($conn, "DELETE FROM `typing_master` WHERE id = '".$_GET['id']."'");
$deleteTypingTests = mysqli_query($conn, "DELETE FROM `typing_test` WHERE department_id = '".$_GET['id']."'");

if($deleteTypingMaster == 1)
{
    $_SESSION["message"] = "Typing Master Deleted Successfully";
    header('Location: '.'typing-master.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Typing Master Data";
    header('Location: '.'typing-master.php');
}
?>