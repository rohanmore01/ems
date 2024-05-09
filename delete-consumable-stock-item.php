<?php
include "header.php";

$deleteConsumableStockItem = mysqli_query($conn, "DELETE FROM `consumable_stock_items` WHERE id = '".$_GET['id']."'");

$deleteConsumableStockItemUploads = mysqli_query($conn, "DELETE FROM `consumable_stock_items_uploads` WHERE item_id = '".$_GET['id']."'");

if($deleteConsumableStockItem == 1 && $deleteConsumableStockItemUploads == 1)
{
    $_SESSION["message"] = "Stock Item Deleted Successfully";
    header('Location: '.'consumable-stock-items.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Stock Item";
    header('Location: '.'consumable-stock-items.php');
}
?>