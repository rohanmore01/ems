<?php
ini_set('display_errors', '1');
include "header.php";

if($_GET['key'] && $_GET['token'])
{
	$email = $_GET['key'];
	$token = $_GET['token'];

	$VerifyEmpQuery = mysqli_query($conn,
	"SELECT * FROM `employees` WHERE `email_verification_link`='".$token."' and `email`='".$email."';"
	);
	$currentDate = date('Y-m-d H:i:s');
	if (mysqli_num_rows($VerifyEmpQuery) > 0) 
	{
		$row= mysqli_fetch_array($VerifyEmpQuery);

		if($row['email_verified_at'] == NULL)
		{
			mysqli_query($conn,"UPDATE employees set email_verified_at ='" . $currentDate . "', status ='1' WHERE email='" . $email . "'");

			$msg = "<h1>Congratulations ! Your email has been verified.</h1> <p><a href='login.php'>Click Here</a> to Login</p>";
		}
		else
		{
			$msg = "<h1>You have already verified your account with us.</h1><p><a href='login.php'>Click Here</a> to Login</p>";
		}
	} 
	else 
	{
		$msg = "<p>This email has been not registered with us</p>";
	}
}
else
{
	$msg = "<p>Danger! Your something goes to wrong.</p>";
}
?>

<span id="success" class="alert-section"  style="position:absolute;left:565px;">
	<p class="text-center"><?php echo $msg; ?></p>               
</span>;