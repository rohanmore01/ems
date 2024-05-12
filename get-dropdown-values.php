<?php
include 'db.php';

if($_POST['select_field'] == 'hardware_name')
{
$getHardwareList = mysqli_query($conn, 'SELECT hardware_name FROM `hardware_list`');

$html = '';
while($row = mysqli_fetch_assoc($getHardwareList))
{
$html .= '<option value="'.$row['hardware_name'].'">'.$row['hardware_name'].'</option>';
}

echo $html;
}
else if($_POST['select_field'] == 'vendor_name')
{
$getVendorList = mysqli_query($conn, 'SELECT vendor_name FROM `vendor_list`');

$html = '';
while($row = mysqli_fetch_assoc($getVendorList))
{
$html .= '<option value="'.$row['vendor_name'].'">'.$row['vendor_name'].'</option>';
}

echo $html;
}
else
{

}

?>