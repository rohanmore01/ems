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
        <h4 class="text-center">Create Dropdown Master</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Dropdown Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="dropdown_name" name="dropdown_name" required="">
                            </div>
                          </div>
                        </div>                  
                      </div>     
                      <div class="row">
                        <div class="col-md-6 ">
                            <a href="dropdown-master.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-dropdown-form">Submit</button>
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
if(isset($_POST['submit-add-dropdown-form']))
{
  $insertQuery = "INSERT INTO dropdown_master(id, dropdown_name, created_by) VALUES(UUID(),'" . $_POST['dropdown_name'] . "','" . $_SESSION["id"] . "')";
  $addDropDown = mysqli_query($conn, $insertQuery);

  if($addDropDown == 1)
  {
      $_SESSION["message"] = "Dropdown Master Added Successfully";
      header('Location: '.'dropdown-master.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Insert Data";
      header('Location: '.'dropdown-master.php');
  }
}
?>