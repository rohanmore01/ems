<?php
include "header.php";

$deleteNonConsumableStockItem = mysqli_query($conn, "DELETE FROM `non_consumable_stock_items` WHERE id = '".$_GET['id']."'");

$deleteNonConsumableStockItemUploads = mysqli_query($conn, "DELETE FROM `non_consumable_stock_items_uploads` WHERE item_id = '".$_GET['id']."'");

if($deleteNonConsumableStockItem == 1 && $deleteNonConsumableStockItemUploads == 1)
{
    $_SESSION["message"] = "Stock Item Deleted Successfully";
    header('Location: '.'non-consumable-stock-items.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Stock Item";
    header('Location: '.'non-consumable-stock-items.php');
}
?>