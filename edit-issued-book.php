<?php
include "header.php";

$selectBookIssueReturn = mysqli_query($conn, "SELECT * FROM `book_issue_return` WHERE `id` = '" . $_GET['id'] . "';");
$book = mysqli_fetch_assoc($selectBookIssueReturn);

$selectEmp = mysqli_query($conn, "SELECT id, first_name, last_name FROM `employees` WHERE `id` = '" . $book['user'] . "';");
$selectEmp = mysqli_fetch_assoc($selectEmp);
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Return Book</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Book Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="book_name" name="book_name" value="<?php echo $book['book_name']; ?>" required="" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="user" name="user" disabled>
                                        <option value="<?php echo $selectEmp['id']; ?>"><?php echo $selectEmp['first_name']." ".$selectEmp['last_name']; ?></option>      
                                    </select>
                                </div>
                           </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Issue Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?php echo $book['issue_date']; ?>" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Return Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="return_date" name="return_date" value="<?php echo $book['return_date']; ?>" required="" max="<?php echo date("Y-m-d") ?>">
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 ">
                            <a href="book-details.php?id=<?php echo $book['book_id']; ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-book-return-form">Submit</button>
                        </div>
                      </div> 
          </form>
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

<?php

if(isset($_POST['submit-book-return-form']))
{
    $updateQuery = "UPDATE `book_issue_return` SET `issue_date`='".$_POST['issue_date']."', `return_date`='".$_POST['return_date']."',`status`='Return', `updated_by`='".$_SESSION['id']."' WHERE id='".$_GET['id']."'";
    
    $returnBook = mysqli_query($conn,$updateQuery);

    if($returnBook == 1)
    {
        $_SESSION["message"] = "Book Return Successfully";
        header('Location: '.'book-details.php?id='.$book["book_id"]);
    }
    else
    {
        $_SESSION["message"] = "Unable to Return Book";
        header('Location: '.'book-details.php?id='.$book["book_id"]);
    }
}
?>