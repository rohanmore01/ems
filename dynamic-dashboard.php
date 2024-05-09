<?php
ini_set('display_errors', '1');
include "db.php";

if($_POST['userType']== 'admin')
{
    //total employees
    $totalEmployeesQuery = 'SELECT * FROM `employees`';
    $totalEmployeesQueryResult = mysqli_query($conn,$totalEmployeesQuery);
    $totalEmployeesQueryCount = mysqli_num_rows($totalEmployeesQueryResult);

    $data["total_emp_query"] = $totalEmployeesQuery;
    $data['total_emp_count'] = $totalEmployeesQueryCount;

    // for attendance
    $selectPresentAttendanceQuery = "SELECT * FROM `attendance` WHERE `status`='P' AND `date` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."'";
    $selectPresentAttendanceQueryResult = mysqli_query($conn,$selectPresentAttendanceQuery);
    $selectPresentAttendanceCount = mysqli_num_rows($selectPresentAttendanceQueryResult);

    $selectAbsentAttendanceQuery = "SELECT * FROM `attendance` WHERE `status`='A' AND `date` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."'";
    $selectAbsentAttendanceQueryResult = mysqli_query($conn,$selectAbsentAttendanceQuery);
    $selectAbsentAttendanceCount = mysqli_num_rows($selectAbsentAttendanceQueryResult);

    $data["present_attendance_query"] = $selectPresentAttendanceQuery;
    $data['present_attendance_count'] = $selectPresentAttendanceCount;
    $data['absent_attendance_query'] = $selectAbsentAttendanceQuery;
    $data['absent_attendance_count'] = $selectAbsentAttendanceCount;

    // for Leave
    $selectLeaveApplicationRequestQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Requested' AND `created_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationRequestResult = mysqli_query($conn,$selectLeaveApplicationRequestQuery);
    $selectLeaveApplicationRequestCount = mysqli_num_rows($selectLeaveApplicationRequestResult);

    $selectLeaveApplicationApproveQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Approved' AND `updated_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationApproveResult = mysqli_query($conn,$selectLeaveApplicationApproveQuery);
    $selectLeaveApplicationApproveCount = mysqli_num_rows($selectLeaveApplicationApproveResult);

    $selectLeaveApplicationRejectedQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Rejected' AND `updated_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationRejectedResult = mysqli_query($conn,$selectLeaveApplicationRejectedQuery);
    $selectLeaveApplicationRejectedCount = mysqli_num_rows($selectLeaveApplicationRejectedResult);

    $data["leave_request_query"] = $selectLeaveApplicationRequestQuery;
    $data['leave_request_count'] = $selectLeaveApplicationRequestCount;
    $data["leave_approve_query"] = $selectLeaveApplicationApproveQuery;
    $data['leave_approve_count'] = $selectLeaveApplicationApproveCount;
    $data["leave_reject_query"] = $selectLeaveApplicationRejectedQuery;
    $data['leave_reject_count'] = $selectLeaveApplicationRejectedCount;

    echo json_encode($data);
}

if($_POST['userType']== 'user')
{
    //total employees
    $totalEmployeesQuery = 'SELECT * FROM `employees` WHERE 1';
    $totalEmployeesQueryResult = mysqli_query($conn,$totalEmployeesQuery);
    $totalEmployeesQueryCount = mysqli_num_rows($totalEmployeesQueryResult);

    $data["total_emp_query"] = $totalEmployeesQuery;
    $data['total_emp_count'] = $totalEmployeesQueryCount;

    // for attendance
    $selectPresentAttendanceQuery = "SELECT * FROM `attendance` WHERE `status`='P' AND `user_id`='".$_POST['userId']."'  AND `date` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."'";
    $selectPresentAttendanceQueryResult = mysqli_query($conn,$selectPresentAttendanceQuery);
    $selectPresentAttendanceCount = mysqli_num_rows($selectPresentAttendanceQueryResult);

    $selectAbsentAttendanceQuery = "SELECT * FROM `attendance` WHERE `status`='A' AND `user_id`='".$_POST['userId']."'  AND `date` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."'";
    $selectAbsentAttendanceQueryResult = mysqli_query($conn,$selectAbsentAttendanceQuery);
    $selectAbsentAttendanceCount = mysqli_num_rows($selectAbsentAttendanceQueryResult);

    $data["present_attendance_query"] = $selectPresentAttendanceQuery;
    $data['present_attendance_count'] = $selectPresentAttendanceCount;
    $data['absent_attendance_query'] = $selectAbsentAttendanceQuery;
    $data['absent_attendance_count'] = $selectAbsentAttendanceCount;

    // for Leave
    $selectLeaveApplicationRequestQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Requested' AND `user_id`='".$_POST['userId']."' AND `created_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationRequestResult = mysqli_query($conn,$selectLeaveApplicationRequestQuery);
    $selectLeaveApplicationRequestCount = mysqli_num_rows($selectLeaveApplicationRequestResult);

    $selectLeaveApplicationApproveQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Approved' AND `user_id`='".$_POST['userId']."' AND `updated_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationApproveResult = mysqli_query($conn,$selectLeaveApplicationApproveQuery);
    $selectLeaveApplicationApproveCount = mysqli_num_rows($selectLeaveApplicationApproveResult);

    $selectLeaveApplicationRejectedQuery = "SELECT * FROM `leave_application` WHERE `status` = 'Rejected' AND `user_id`='".$_POST['userId']."' AND `updated_at` BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
    $selectLeaveApplicationRejectedResult = mysqli_query($conn,$selectLeaveApplicationRejectedQuery);
    $selectLeaveApplicationRejectedCount = mysqli_num_rows($selectLeaveApplicationRejectedResult);

    $data["leave_request_query"] = $selectLeaveApplicationRequestQuery;
    $data['leave_request_count'] = $selectLeaveApplicationRequestCount;
    $data["leave_approve_query"] = $selectLeaveApplicationApproveQuery;
    $data['leave_approve_count'] = $selectLeaveApplicationApproveCount;
    $data["leave_reject_query"] = $selectLeaveApplicationRejectedQuery;
    $data['leave_reject_count'] = $selectLeaveApplicationRejectedCount;

    echo json_encode($data); 
}

?>