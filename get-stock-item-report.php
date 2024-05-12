<?php
ob_start();
include 'db.php';

$getStockItemData = mysqli_query($conn, $_GET['query']);

$rowCount = mysqli_num_rows($getStockItemData);

if($rowCount > 0)
{
    $fileName = $_GET['table']."_stock_item_report_" . date('d_m_Y') . ".xls";
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");

    // Write data to file
    $flag = false;
    while ($row = mysqli_fetch_assoc($getStockItemData))
    {
        if (!$flag)
        {
            // display field/column names as first row
            echo ucwords(implode("\t", str_replace('_', ' ',array_keys($row)))). "\r\n";
            $flag = true;
        }
        echo implode("\t", array_values($row)) . "\r\n";
    }

}
else
{
    echo '<script>alert("No Record Found")</script>';
}
?>