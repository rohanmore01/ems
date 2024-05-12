<?php
include "header.php";

$deleteOutwardEntry = mysqli_query($conn, "DELETE FROM `outwards` WHERE id = '".$_GET['id']."'");

if($deleteOutwardEntry == 1)
{
    $_SESSION["message"] = "Outward Entry Deleted Successfully";
    header('Location: '.'outwards.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Outward Entry";
    header('Location: '.'outwards.php');
}
?>