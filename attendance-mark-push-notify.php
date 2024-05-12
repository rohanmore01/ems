<?php
ini_set('display_errors', '1');
include "db.php";
session_start();

    $todayDate = date("Y-m-d");

    $checkAttendanceRecordExist = mysqli_query($conn,"SELECT * FROM attendance WHERE emp_id='" . $_SESSION["emp_id"] . "' AND date='" . $todayDate . "'");

    $row = mysqli_num_rows($checkAttendanceRecordExist);

    if($row > 0)
    {
        $getAttendanceRecord = mysqli_fetch_array($checkAttendanceRecordExist);

        if($getAttendanceRecord['status'] == 'A')
        {
            $webNotificationPayload['title'] = 'Notification from EMS';
            $webNotificationPayload['body'] = 'Please Mark Your Attendance';
            $webNotificationPayload['icon'] = 'http://localhost/EMS/images/notification-icon.png';
            $webNotificationPayload['url'] = 'http://localhost/ems/mark-attendance.php';
            echo json_encode($webNotificationPayload);
            exit();
        }
        else
        {
            exit();
        } 
    }
    else
    {
        exit();
    }
?>