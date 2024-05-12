<?php
include "header.php";

    $deleteQuery = "DELETE FROM `leave_application` WHERE id = '".$_GET['id']."'";
    $deleteLeaveApplication = mysqli_query($conn, $deleteQuery);

    if($deleteLeaveApplication == 1)
    {
        $_SESSION["message"] = "Leave Application Deleted Successfully";
        header('Location: '.'leave-application.php');
    }
    else
    {
    	$message = "Unable to Delete Leave Application";
    	echo $message;
    }
?>