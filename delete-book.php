<?php
include "header.php";

$deleteBook = mysqli_query($conn, "DELETE FROM `books` WHERE id = '".$_GET['id']."'");

$deleteIssueReturnBook = mysqli_query($conn, "DELETE FROM `book_issue_return` WHERE book_id = '".$_GET['id']."'");

if($deleteBook == 1)
{
    $_SESSION["message"] = "Book Deleted Successfully";
    header('Location: '.'books.php');
}
else
{
    $_SESSION["message"] = "Unable to Delete Book";
    header('Location: '.'books.php');
}
?>