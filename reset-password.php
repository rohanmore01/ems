<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="images/nic-logo.png">
                </div>
                <h4>Reset Password</h4>
                <form class="pt-3" name="registrationForm" method="post" autocomplete="off">
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" required="" placeholder="Enter New Password">
                  </div>
                  <div class="form-group">
                  <input type="password" name="cpassword" class="form-control" id="cpassword" required="" placeholder="Enter New Confirm Password">
                  </div>
                  <div class="mt-3">
                    <input type="submit" name="submit-reset-password-form" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Submit">
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">         
                  </div>             
                  <div class="text-center mt-4 font-weight-light">Click Here To <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>  
</body>
</html>
<?php

if(isset($_GET['id']) && isset($_GET['token']))
{
  session_start();
  include "db.php";

  if(isset($_POST['submit-reset-password-form']))
  {
    //hash password
    $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
    $hashedPassword   = hash('sha256', $_POST['cpassword'] . $salt);

    $updateQuery = "UPDATE employees set password ='" . $hashedPassword ."', email_verification_link=UUID() WHERE id='" . $_GET['id'] . "' AND email_verification_link='" . $_GET['token'] . "'";
    
    $updatePassword = mysqli_query($conn, $updateQuery);
    
    if(mysqli_affected_rows($conn) > 0)
    {
      $_SESSION["message"] = '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align:center";>
      <strong>Password Reset Done Please Login Now</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
      header('Location: '.'login.php');
    }
    else
    {
      $_SESSION["message"] = '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align:center";>
      <strong>Password Reset Link is Expired</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
      header('Location: '.'login.php');
    }
  }
}
else
{
  header('Location: '.'login.php');
}
?>
<script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" > </script>
<script src="js/main.js"></script>