<?php
include "header.php";

$deleteInwardEntry = mysqli_query($conn, "DELETE FROM `inwards` WHERE id = '".$_GET['id']."'");

if($deleteInwardEntry == 1)
{
    $_SESSION["message"] = "Inward Entry Deleted Successfully";
    header('Location: '.'inwards.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Inward Entry";
    header('Location: '.'inwards.php');
}
?>