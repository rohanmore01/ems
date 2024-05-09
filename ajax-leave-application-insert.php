<?php
include "header.php";
include "db.php";

    $data = array();
    parse_str($_POST['data'], $data);

    if(isset($_FILES['doc_file']))
    {
        $fileName = $_FILES['doc_file']['name'];
        $docName = chunk_split(base64_encode(file_get_contents($_FILES['doc_file']['tmp_name'])));
    }

    $insertQuery = "INSERT INTO leave_application(id, user_id, emp_id, subject, status, from_date, to_date, leave_type, leave_duration, no_of_days, doc_upload, doc_name, created_at, created_by) VALUES(UUID(),'" . $_SESSION['id'] . "','" . $_SESSION['emp_id'] . "','" . $data['subject'] . "', '" . $data['status'] . "','" . $data['from_date'] . "','" . $data['to_date'] . "','" . $data['leave_type'] . "','" . $data['leave_duration'] . "','" . $data['no_of_days']."', '" . $docName."', '" . $fileName."', now(),'" . $_SESSION['id']."')";
    $insertLeaveApplication = mysqli_query($conn, $insertQuery);

    if($insertLeaveApplication == 1)
    {
        $_SESSION["message"] = "Leave Application Created Successfully";
    }
    else
    {
        $_SESSION["message"] = "Unable to Insert Data";
    }

?>