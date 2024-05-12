<?php
include "db.php";

if($_POST['leaveApplicationAction'] == 'reject')
{
    $updateQuery = "UPDATE `leave_application` SET `status`='Rejected', `remark`='".$_POST['rejectReason']."', `updated_at`=now() WHERE id='".$_POST['leaveApplicationId']."'";
        
    $updateLeaveApplication = mysqli_query($conn,$updateQuery);

    if($updateLeaveApplication == 1)
    {
        $data['status'] = 1;
        $data['action'] = "Rejected";
        $data['reject_reason'] = $_POST['rejectReason'];
        $data['row_id'] = $_POST['leaveApplicationId'];
        echo json_encode($data);
    }
    else
    {
        $data['status'] = 0;
        echo json_encode($data);
    }   
}
if($_POST['leaveApplicationAction'] == 'approved')
{
    $updateQuery = "UPDATE `leave_application` SET `status`='Approved',`remark`='', `updated_at`=now()  WHERE id='".$_POST['leaveApplicationId']."'";
    
    $updateLeaveApplication = mysqli_query($conn,$updateQuery);

    if($updateLeaveApplication == 1)
    {
        $data['status'] = 1;
        $data['action'] = "Approved";
        $data['row_id'] = $_POST['leaveApplicationId'];
        echo json_encode($data);
    }
    else
    {
        $data['status'] = 0;
        echo json_encode($data);
    }
}
?>