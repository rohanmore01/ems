<?php
include "header.php";

$selectEmployees = mysqli_query($conn, "SELECT id, first_name, last_name FROM `employees` WHERE 1;");
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Issue Book</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Book Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="book_name" name="book_name" value="<?php echo $_GET['book_name']; ?>" required="" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="user" name="user" required>
                                        <option value=""></option>
                                        <?php
                                        while ($employees = mysqli_fetch_assoc($selectEmployees)) 
                                        { ?>
                                            <option value="<?php echo $employees['id']; ?>"><?php echo $employees['first_name']." ".$employees['last_name']; ?></option>      
                                        <?php 
                                        }
                                        ?>
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
                            <input type="date" class="form-control" id="issue_date" name="issue_date" required="" min="<?php echo date("Y-m-d") ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Due Date</label>
                              <div class="col-sm-9">
                              <input type="date" class="form-control" id="due_date" name="due_date" required="">
                              </div>
                            </div>
                        </div>
                      </div>
                      <a href="book-details.php?id=<?php echo $_GET['id']; ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                      <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-book-issue-form">Submit</button>
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

if(isset($_POST['submit-book-issue-form']))
{
    $insertQuery = "INSERT INTO book_issue_return(id, book_id, book_name, user, issue_date, return_date, status, due_date,created_by) VALUES(UUID(),'" . $_GET['id'] . "','" . $_GET['book_name'] . "','" . $_POST['user'] . "', '" .  $_POST['issue_date'] . "','" . $_POST['return_date'] . "','Issued', '" . $_POST['due_date'] . "', '" . $_SESSION['id'] . "')";

    $bookIssue = mysqli_query($conn, $insertQuery);

    if($bookIssue == 1)
    {
        $_SESSION["message"] = "Book Issued Successfully";
        header('Location: '.'book-details.php?id='.$_GET["id"]);
    }
    else
    {
        $_SESSION["message"] = "Unable to Issue Book Data";
        header('Location: '.'book-details.php?id='.$_GET["id"]);
    }
}
?>

<script>
  $("#issue_date").change(function(){
    
  var issueDate = new Date($('#issue_date').val());
  var dueDate = issueDate.setTime(issueDate.getTime() + (7 * 24 * 60 * 60 * 1000));
  dueDate = new Date(dueDate);  
  $("#due_date").val(dueDate.getFullYear()+ "-" + String(dueDate.getMonth()+1).padStart(2, '0')+"-" + String(dueDate.getDate()).padStart(2, '0'));
  });
</script>