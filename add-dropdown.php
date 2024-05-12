<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Add <?php echo $_GET['name']; ?> Dropdown</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" required="">
                            </div>
                          </div>
                        </div>                  
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Value</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="value" name="value" required="">
                            </div>
                          </div>
                        </div>                  
                      </div>     
                      <div class="row">
                        <div class="col-md-6 ">
                            <a href="dropdown-list.php?id=<?php echo $_GET['id']; ?>&name=<?php echo $_GET['name']; ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-dropdown-list-form">Submit</button>
                        </div>
                        <div class="col-md-6">        
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
if(isset($_POST['submit-add-dropdown-list-form']))
{
  $insertQuery = "INSERT INTO dropdown_list(id, name, value, dropdown_id, created_by) VALUES(UUID(),'" . $_POST['name'] . "','" . $_POST['value'] . "','" . $_GET['id'] . "','" . $_SESSION["id"] . "')";

  $addDropDown = mysqli_query($conn, $insertQuery);

  if($addDropDown == 1)
  {
      $_SESSION["message"] = "Dropdown Added Successfully";
      header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
  }
  else
  {
      $_SESSION["message"] = "Unable to Insert Data";
      header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
  }
}
?>