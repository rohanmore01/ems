<?php
include "header.php";

$deleteDropDown = mysqli_query($conn, "DELETE FROM `dropdown_list` WHERE id = '".$_GET['dropdown_id']."'");

if($deleteDropDown == 1)
{
    $_SESSION["message"] = "Dropdown Deleted Successfully";
    header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
}
else
{
    $_SESSION["message"] = "Unable to Delete Dropdown";
    header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
}
?>