<?php
include "header.php";

$deleteDropDownMaster = mysqli_query($conn, "DELETE FROM `dropdown_master` WHERE id = '".$_GET['id']."'");
$deleteDropDownList = mysqli_query($conn, "DELETE FROM `dropdown_list` WHERE dropdown_id = '".$_GET['id']."'");

if($deleteDropDownMaster == 1 && $deleteDropDownList == 1)
{
    $_SESSION["message"] = "Dropdown Master Deleted Successfully";
    header('Location: '.'dropdown-master.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Dropdown Master";
    header('Location: '.'dropdown-master.php');
}
?>