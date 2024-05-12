<?php
include "header.php";

$deleteIssueReturnBook = mysqli_query($conn, "DELETE FROM `book_issue_return` WHERE id = '".$_GET['id']."'");

if($deleteIssueReturnBook == 1)
{
    $_SESSION["message"] = "Book Issued Deleted Successfully";
    header('Location: '.'book-details.php?id='.$_GET["book_id"]);
}
else
{
    $_SESSION["message"] = "Unable to Delete Issued Book";
    header('Location: '.'book-details.php?id='.$_GET["book_id"]);
}
?>