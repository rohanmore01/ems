<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectDropDown = mysqli_query($conn, "SELECT * FROM `dropdown_list` WHERE `id` = '" . $_GET['dropdown_id'] . "';");
    $dropDown = mysqli_fetch_assoc($selectDropDown);
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit <?php echo $_GET['name']; ?> Dropdown</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" required="" value="<?php echo $dropDown['name']; ?>">
                            </div>
                          </div>
                        </div>                  
                      </div> 
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Value</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="value" name="value" required="" value="<?php echo $dropDown['value']; ?>">
                            </div>
                          </div>
                        </div>                  
                      </div>     
                      <div class="row">
                        <div class="col-md-6 ">
                            <a href="dropdown-list.php?id=<?php echo $_GET['id']; ?>&name=<?php echo $_GET['name']; ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-edit-dropdown-list-form">Submit</button>
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
if(isset($_POST['submit-edit-dropdown-list-form']))
{
    $updateQuery = "UPDATE `dropdown_list` SET `name`='".$_POST['name']."', `value`='".$_POST['value']."',`updated_by`='".$_SESSION['id']."' WHERE id='".$_GET['dropdown_id']."'";
    
    $updateDropDown = mysqli_query($conn,$updateQuery);

    if($updateDropDown == 1)
    {
        $_SESSION["message"] = "Dropdown updated Successfully";
        header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
    }
    else
    {
        $_SESSION["message"] = "Unable to update Data";
        header('Location: '.'dropdown-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
    }
}
?>