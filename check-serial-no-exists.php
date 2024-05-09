<?php
ini_set('display_errors', '1');
include "db.php";

$checkStockItemExistsQuery = mysqli_query($conn,"SELECT id FROM $_POST[table] WHERE serial_number='" . $_POST['serialNo'] . "'");
$checkStockItemExists = mysqli_num_rows($checkStockItemExistsQuery);

if($checkStockItemExists == 0)
{
    $data['status'] = 0;
    $data['msg'] = 'Stock Item Not Found' ;
    echo json_encode($data); 
}
else
{
    $data['status'] = 1;
    $data['msg'] = 'This Stock Item already exists' ;
    echo json_encode($data); 
}
?>