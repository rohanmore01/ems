<?php

session_start();

if(isset($_SESSION["id"]))
{
    header('Location: '.'index.php');
}
else
{
?>
<!-- flash alert message link -->
<link rel="stylesheet" href="MaterialDesign-Webfont-master/fonts/fa-fa-icons.min.css" />
<script src="js/vendor.bundle.base.js"></script>
<link rel="stylesheet" href="css/alert-message.css" />
<script src="js/alert-message.js"></script>
<script src="js/alert-message-font.js"></script>

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/vendor.bundle.base.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="Master_Images/favicon.ico"/>
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
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="check-login.php" method="post">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required="" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                  <input type="password" name="password" class="form-control" id="password" required="" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                        <img src="generatecaptcha.php?rand=<?php echo rand(); ?>" name="captcha_img" id='image_captcha' > 
                        <a href='javascript: refreshing_Captcha();' title="Refresh Captcha"><i><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" /></svg></i></a> 
                        <script language='JavaScript' type='text/javascript'>
                          function refreshing_Captcha()
                          {
                            var img = document.images['image_captcha'];
                            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
                          }
                        </script>
                  </div>
                    
                  <div class="form-group">
                        <input type="text" name="captcha_code" class="form-control" id="captcha_code" aria-describedby="emailHelp" required="" placeholder="Enter Captcha">
                  </div>
                  
                  <div class="mt-3">
                    <input type="submit" name="submit-login-form" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="LOG IN">
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">         
                    <a class="auth-link text-black forgotPassword">Forgot password?</a>
                  </div>             
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="employee-registration.php" class="text-primary">Create</a>
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
}
?>
<script>
    $(document).ready(function(){

      $(".flash-message").delay(2000).fadeOut(800);

      $(document).on('click', '[name="submit-login-form"]', function(e) {

          var password = $('#password').val();
          if(password != '')
          {
            var salt = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
            password = password+salt;
            $('#password').val(password);
          }
          else
          {
            e.preventDefault();
          }

      });

      $('.forgotPassword').click(function(){

          if($('#email').val() == '')
          {
            alert('Please Enter Your Email Id First');
          }
          else
          {
            window.location = 'forgot-password.php?email='+$('#email').val();
          }
      });
    });

$(".alert-section").delay(2000).fadeOut(800);
</script>