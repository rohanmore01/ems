<?php
ob_start();
ini_set('display_errors', '1');
session_start();

if(isset($_POST['submit-login-form']))
{
	include "db.php";

    //Captch Check
	if($_SESSION['code_confirmation'] != $_POST['captcha_code'])
    {
		$_SESSION["message"] = 'Entered Captcha did not Matched';
        header('Location: '.'login.php');
	}
    else
    {
        //hash password
        $hashedPassword   = hash('sha256', $_POST['password']);

        $checkEmailPassInDb = mysqli_query($conn,"SELECT * FROM employees WHERE email='" . $_POST['email'] . "' AND  password='" . $hashedPassword . "'");

        $row = mysqli_num_rows($checkEmailPassInDb);

        if($row > 0)
        {
            $row = mysqli_fetch_array($checkEmailPassInDb);
            if($row['status'] == 1 && $row['email_verified_at'] != NULL)
            {
                $_SESSION["id"] = $row['id'];
                $_SESSION["user_type"] = $row['user_type'];
                $_SESSION["emp_id"] = $row['emp_id'];
                $_SESSION["first_name"] = $row['first_name'];
                $_SESSION["last_name"] = $row['last_name'];
                $_SESSION["encoded_photo"] = $row['encoded_photo'];
                $_SESSION["designation"] = $row['designation'];

                $checkUserPreferenceAvailable = mysqli_query($conn,"SELECT * FROM user_preferences WHERE user_id='" . $_SESSION["id"] . "' ");
                $checkUserPreferenceCount = mysqli_num_rows($checkUserPreferenceAvailable);
                if($checkUserPreferenceCount == 0)
                {
                    mysqli_query($conn,"INSERT INTO `user_preferences`(`id`, `user_id`) VALUES (UUID() , '" . $_SESSION["id"] . "') ");   
                }

                header('Location: '.'index.php');
            }
            else
            { 
                    $_SESSION["message"] = 'Your Account is Not Activated';
                    header('Location: '.'login.php');
            }
        }
        else
        {
            $_SESSION["message"] = 'Invalid Login Credentials';
            header('Location: '.'login.php');
        }
    }
}
?>