<?php
include "header.php";

$deleteTypingTest = mysqli_query($conn, "DELETE FROM `typing_test` WHERE id = '".$_GET['id']."'");

if($deleteTypingTest == 1)
{
    $_SESSION["message"] = "Typing Test Deleted Successfully";
    header('Location: '.'typing-test.php?id='.$_GET['department_id']);
}
else
{
    $_SESSION["message"] = "Unable to Delete Typing Test Data";
    header('Location: '.'typing-test.php');
}
?>