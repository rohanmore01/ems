<?php
ob_start();
session_start();
include "header.php";

    $deleteQuery = "DELETE FROM `employees` WHERE id = '".$_GET['id']."' AND id !='".$_SESSION['id']."'";
    $deleteEmployee = mysqli_query($conn, $deleteQuery);

    if($deleteEmployee == 1)
    {
        if($_GET['id'] == $_SESSION['id'])
        {
            $_SESSION["message"] = "You Cannot Delete Your Own Record...";
        }
        else
        {
            $deleteAttendanceQuery = "DELETE FROM `attendance` WHERE user_id = '".$_GET['id']."'";
            mysqli_query($conn, $deleteAttendanceQuery);

            $deleteLeaveQuery = "DELETE FROM `leave_application` WHERE user_id = '".$_GET['id']."'";
            mysqli_query($conn, $deleteLeaveQuery);

            if($_GET['emp_category'] =='FMS')
            {
                $_SESSION["message"] = "FMS Deleted Successfully";
                header('Location: '.'fms.php');
            }
            else if($_GET['emp_category'] =='Officer')
            {
                $_SESSION["message"] = "Officer Deleted Successfully";
                header('Location: '.'officers.php');
            }
            else
            {
                $_SESSION["message"] = "Employee Deleted Successfully";
                header('Location: '.'employees.php');
            }
        }
    }
    else
    {
    	$message = "<center><span style='color:red;position:relative;top:10px;'>Unable to Delete Record</span></center>";
    	echo $message;
    }
?>