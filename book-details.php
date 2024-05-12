<?php
include "header.php";
?>

<?php
    $selectBook = mysqli_query($conn, "SELECT * FROM `books` WHERE `id` = '" . $_GET['id'] . "';");
    $book = mysqli_fetch_assoc($selectBook);
?>

<style>
td.issued 
{
    color: green;
}
td.return 
{
    color: blue;
}
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <?php
        if(isset($_SESSION["message"]))
        {
            echo '<span id="success" class="alert-section">
            <p class="text-center">'.$_SESSION["message"].'</p>
            <i class="fa fa-times succ" aria-hidden="true"></i>
            </span>';
            unset($_SESSION["message"]);
        }
    ?>
  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Book Details

        <?php
        if($_SESSION["user_type"] == "admin")
        { 
        ?>
        <a type="button" href='book-issue.php?id=<?php echo $_GET['id']; ?>&book_name=<?php echo $book['book_name']; ?>' title="Issue Book" class="btn btn-outline-success float-right btn-sm">Issue Book</a>
        <?php 
        } ?>
        <a type="button" href='books.php' title="Back" class="btn btn-outline-secondary float-right btn-sm mr-2">Back</a>

        </h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tbody>
                    <tr>
                        <td>Book Name</td>
                        <td colspan=3><?php echo $book['book_name'];  ?></td>
                    </tr>
                    <tr>
                        <td>ISBN No.</td>
                        <td><?php if($book['isbn_no']==''){ echo "NA"; } else { echo $book['isbn_no']; } ?></td>
                        <td>Category</td>
                        <td><?php if($book['category']==''){ echo "NA"; } else { echo $book['category']; } ?></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><?php if($book['author']==''){ echo "NA"; } else { echo $book['author']; }  ?></td>
                        <td>Price</td>
                        <td><?php if($book['price']==''){ echo "NA"; } else { echo $book['price']; } ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <?php
            $getBookIssueReturn = mysqli_query($conn, "SELECT * FROM `book_issue_return` WHERE `book_id` = '".$_GET['id']."' ");
            $numRows = mysqli_num_rows($getBookIssueReturn);
            if($numRows > 0)
            { ?>
            <br>
        <h4 class="text-center">Book Issue Or Return Details</h4>
        <hr style="border-top: 1px solid black;">
        <div class="table-responsive">
        <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Book Name</th>
                    <th>User</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <?php
                    if($_SESSION["user_type"] == "admin")
                    { 
                    ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
              </thead>
              <?php
                    while ($book = mysqli_fetch_assoc($getBookIssueReturn)) 
                    {
                        $getEmpName = mysqli_query($conn, "SELECT first_name, last_name FROM `employees` WHERE id='".$book['user']."';");
                        $getEmpName = mysqli_fetch_assoc($getEmpName);
              ?>
                        <tr>
                            <td><?php echo $book['book_name'] ?></td>
                            <td><?php echo $getEmpName['first_name']." ".$getEmpName['last_name']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($book['issue_date'])); ?></td>
                            <td><?php if($book['return_date']) { echo date("d-m-Y", strtotime($book['return_date'])); } else { echo ''; } ?></td>
                            <td><?php echo date("d-m-Y", strtotime($book['due_date'])); ?></td>
                            <td class="<?php echo $book['status'] ?>"><?php echo $book['status'] ?></td>
                            <?php
                            if($_SESSION["user_type"] == "admin")
                            { 
                            ?>
                            <td>
                            <a type="submit" class="badge badge-success" title="Edit" href="edit-issued-book.php?id=<?php echo $book['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>

                            <a type="submit" class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" title="Delete" href="delete-issued-book.php?id=<?php echo $book['id'] ?>&book_id=<?php echo $_GET['id'] ?>" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                            </a>
                            </td>
                            <?php 
                            } ?>
                        </tr>
            <?php
                    }
              ?>
              <tbody>
              </tbody>
        </table>
        </div>
        <?php
            }
        ?>

      </div>
  </div>
  </div>
</div>
</div>

<!-- Header End Part -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
</body>
</html>

<script>
  $(".alert-section").delay(2000).fadeOut(800);
</script>