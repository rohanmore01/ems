<?php
include "header.php";

$deleteWorkOrder = mysqli_query($conn, "DELETE FROM `work_orders` WHERE id = '".$_GET['id']."'");

if($deleteWorkOrder == 1)
{
    $_SESSION["message"] = "Work Order Deleted Successfully";
    header('Location: '.'work-orders.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Work Order";
    header('Location: '.'work-orders.php');
}
?>