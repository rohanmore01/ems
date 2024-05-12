<?php
ini_set('display_errors', '1');
include "db.php";

$checkEmpExistsQuery = mysqli_query($conn,"SELECT id FROM employees WHERE emp_id='" . $_POST['eno'] . "'");
$checkEmpExists = mysqli_num_rows($checkEmpExistsQuery);
if($checkEmpExists == 0)
{
    $data['status'] = 0;
    $data['msg'] = '<h6 style="color:red">Invalid Employee ID</h6>' ;
    echo json_encode($data); 
}
else
{
    $data['status'] = 1;
    $data['msg'] = '<h6 style="color:red">Employee Found</h6>' ;
    echo json_encode($data); 
}
?>