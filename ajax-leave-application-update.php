<?php
include "header.php";
include "db.php";

    $data = array();
    parse_str($_POST['data'], $data);

    if(isset($_FILES['doc_file']))
    {
        $docName = $_FILES['doc_file']['name'];
        $encodedFile = chunk_split(base64_encode(file_get_contents($_FILES['doc_file']['tmp_name'])));
    }
    else
    {
        $docName = $_POST['attachedFile'];
        $encodedFile = $_POST['encodedFile'];
    }

    $updateQuery = "UPDATE `leave_application` SET `subject`='".$data['subject']."',`status`='".$data['status']."',`from_date`='".$data['from_date']."',`to_date`='".$data['to_date']."',`leave_type`='".$data['leave_type']."',`leave_duration`='".$data['leave_duration']."',`no_of_days`='".$data['no_of_days']."', `doc_upload`='".$encodedFile."', `doc_name`='".$docName."' ,`updated_at`= now(), `updated_by`='".$_SESSION['id']."' WHERE id='".$data['id']."'";
    
    $updateLeaveApplication = mysqli_query($conn, $updateQuery);

    if($updateLeaveApplication == 1)
    {
        $_SESSION["message"] = "Leave Application Updated Successfully";
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
    }

?>