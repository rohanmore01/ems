<?php
include "header.php";

$selectEmailConfiguration = mysqli_query($conn, "SELECT * FROM `email_configuration` WHERE `id` = '1';");
$emailConf = mysqli_fetch_assoc($selectEmailConfiguration);
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Email Configuration</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">

        <?php
          if(mysqli_num_rows($selectEmailConfiguration) > 0)
          {
        ?>
            <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" required="" value="<?php echo $emailConf['email'] ?>">
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">  
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required="" value="<?php echo $emailConf['password'] ?>">
                            </div>
                          </div>
                        </div>
                      </div> 
                      
                      <div class="row">
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="update-email-configuration" value="Save">Save</button>
                        </div>
                      </div>
          </form>

         <?php }
         else
         { ?>

          <form class="form-sample" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" required="">
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">  
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required="">
                            </div>
                          </div>
                        </div>
                      </div> 
                      
                      <div class="row">
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-email-configuration" value="Save">Save</button>
                        </div>
                      </div>
            </form>
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

<?php
if(isset($_POST['submit-email-configuration']))
{
  $insertQuery = "INSERT INTO email_configuration(id, user_id, email, password,created_by) VALUES('1','" . $_SESSION['id'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_SESSION['id'] . "')";

  $addEmailConfiguration = mysqli_query($conn, $insertQuery);

  if($addEmailConfiguration == 1)
  {
      $_SESSION["message"] = "Email Configuration Added";
      header('Location: '.'index.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Add Email Configuration";
      header('Location: '.'index.php');
  }
}

if(isset($_POST['update-email-configuration']))
{
    $updateQuery = "UPDATE `email_configuration` SET `user_id`='".$_SESSION['id']."',`email`='".$_POST['email']."',`password`='".$_POST['password']."' ,`updated_by`='".$_SESSION['id']."' WHERE id='1'";
    
    $updateEmailConfiguration = mysqli_query($conn,$updateQuery);

    if($updateEmailConfiguration == 1)
    {
        $_SESSION["message"] = "Email Configuration Updated";
        header('Location: '.'index.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Email Configuration";
        header('Location: '.'index.php');
    }
}
?>