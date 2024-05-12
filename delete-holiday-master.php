<?php
include "header.php";

$deleteHolidayMaster = mysqli_query($conn, "DELETE FROM `holiday_master` WHERE id = '".$_GET['id']."'");

mysqli_query($conn, "DELETE FROM `holiday_list` WHERE holiday_master = '".$_GET['id']."'");

if($deleteHolidayMaster == 1)
{
    $_SESSION["message"] = "Holiday Master Deleted Successfully";
    header('Location: '.'Holidays.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Holiday Master";
    header('Location: '.'Holidays.php');
}
?>