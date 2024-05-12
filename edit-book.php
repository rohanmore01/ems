<?php
include "header.php";

$selectBook = mysqli_query($conn, "SELECT * FROM `books` WHERE `id` = '" . $_GET['id'] . "';");
$book = mysqli_fetch_assoc($selectBook);

$getBookCategories = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = 'ed6338b9-75f9-11ed-87f1-186024eca36c'");
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit Book</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Book Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="book_name" name="book_name" required="" value="<?php echo $book['book_name']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ISBN No.</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="isbn_no" name="isbn_no" required="" value="<?php echo $book['isbn_no']; ?>">
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
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($book['category'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                                <input type="text" class="form-control" id="author" name="author" required="" value="<?php echo $book['author']; ?>">
                                </div>
                           </div>
                        </div>
                      </div> 
                      
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                <input type="number" class="form-control" id="price" name="price" required="" value="<?php echo $book['price']; ?>">
                                </div>
                           </div>
                        </div>
                        <div class="col-md-6 ">
                            <a href="books.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-edit-book-form">Submit</button>
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
if(isset($_POST['submit-edit-book-form']))
{
    $updateQuery = "UPDATE `books` SET `book_name`='".$_POST['book_name']."',`isbn_no`='".$_POST['isbn_no']."',`category`='".$_POST['category']."',`author`='".$_POST['author']."', `price`='".$_POST['price']."', `updated_by`='".$_SESSION['id']."' WHERE id='".$_GET['id']."'";
    
    $updateBook = mysqli_query($conn,$updateQuery);

    if($updateBook == 1)
    {
        $_SESSION["message"] = "Book Updated Successfully";
        header('Location: '.'books.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'books.php');
    }
}
?>