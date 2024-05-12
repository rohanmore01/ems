<?php
ini_set('display_errors', '1');
include "db.php";

$getEmpIdQuery = mysqli_query($conn,"SELECT emp_id, id FROM employees WHERE `status` = 1");

$todayDate = date("Y-m-d");

$selectCronJob = mysqli_query($conn, "SELECT * FROM `cron_job_setting` WHERE `id` = '1';");
$selectCronJob = mysqli_fetch_assoc($selectCronJob);
$week = explode(",",$selectCronJob['week']);
$day = strtolower(date('l', strtotime($todayDate)));

if(in_array($day, $week))
{
    if($selectCronJob['whether_run_on_holiday'] == "yes")
    {
        while ($getEmpId = mysqli_fetch_array($getEmpIdQuery))
        {    
            $selectAttendaceQuery = mysqli_query($conn,"SELECT * FROM attendance WHERE emp_id='" .$getEmpId['emp_id'] . "' AND date='" .$todayDate . "'");
            $selectAttendaceRow = mysqli_num_rows($selectAttendaceQuery);
            if($selectAttendaceRow == 0)
            {
                $insertAttendanceQuery = mysqli_query($conn,"INSERT INTO `attendance`(`id`, `user_id`, `emp_id`, `date`, `status`) VALUES (UUID(),'" . $getEmpId['id'] . "','" . $getEmpId['emp_id'] . "','" . $todayDate . "','A')");
            }
        }
    }
    else
    {
        $selectHolidayList = mysqli_query($conn, "SELECT * FROM `holiday_list` WHERE `date` = '$todayDate';");
        $selectHolidayListRow = mysqli_num_rows($selectHolidayList);

        if($selectHolidayListRow == 0)
        {
            while ($getEmpId = mysqli_fetch_array($getEmpIdQuery))
            {    
                $selectAttendaceQuery = mysqli_query($conn,"SELECT * FROM attendance WHERE emp_id='" .$getEmpId['emp_id'] . "' AND date='" .$todayDate . "'");
                $selectAttendaceRow = mysqli_num_rows($selectAttendaceQuery);
                if($selectAttendaceRow == 0)
                {
                    $insertAttendanceQuery = mysqli_query($conn,"INSERT INTO `attendance`(`id`, `user_id`, `emp_id`, `date`, `status`) VALUES (UUID(),'" . $getEmpId['id'] . "','" . $getEmpId['emp_id'] . "','" . $todayDate . "','A')");
                }
            }

        }
    }  
}
?>