<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
  $getBookCategories = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = 'ed6338b9-75f9-11ed-87f1-186024eca36c'");
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Add Book</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Book Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="book_name" name="book_name" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ISBN No.</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn_no" name="isbn_no">
                                </div>
                           </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="category" name="category" required>
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($getBookCategories)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['value']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Author</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="author" name="author">
                                </div>
                           </div>
                        </div>
                      </div> 
                      
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                <input type="number" class="form-control" id="price" name="price">
                                </div>
                           </div>
                        </div>
                        <div class="col-md-6 ">
                            <a href="books.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-book-form">Submit</button>
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
} 
else 
{
  header('Location: ' . 'login.php');
}
?>

<?php
if(isset($_POST['submit-add-book-form']))
{
  $insertQuery = "INSERT INTO books(id, book_name, isbn_no, category, author, price,created_by) VALUES(UUID(),'" . $_POST['book_name'] . "','" . $_POST['isbn_no'] . "','" . $_POST['category'] . "', '" . $_POST['author'] . "', '" . $_POST['price'] . "','" . $_SESSION["id"] . "')";
  $addBook = mysqli_query($conn, $insertQuery);

  if($addBook == 1)
  {
      $_SESSION["message"] = "Book Added Successfully";
      header('Location: '.'books.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Insert Data";
      header('Location: '.'books.php');
  }
}
?>