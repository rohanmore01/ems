<?php
session_start();
//Include required PHPMailer files
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';
require 'PhpMailer/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "db.php";

$checkEmailInDb = mysqli_query($conn,"SELECT id, first_name, last_name, email FROM employees WHERE email='" . $_GET['email'] . "' ");
$row = mysqli_num_rows($checkEmailInDb);

if($row > 0)
{  
    $row = mysqli_fetch_assoc($checkEmailInDb);
    $token = rand(10,9999999999999999);
    $name = $row['first_name']." ".$row['last_name'];

    mysqli_query($conn, "UPDATE employees set email_verification_link ='" . $token . "' WHERE email='" . $row['email'] . "' ");

    $link = "<a href=http://".$_SERVER['HTTP_HOST']."/EMS/reset-password.php?id=".$row['id']."&token=".$token." target=_blank>Click Here To Reset Password</a>";

    $getAdminEmail = mysqli_query($conn, "SELECT * FROM `email_configuration` WHERE id ='1' ");
    $getAdminEmail = mysqli_fetch_assoc($getAdminEmail);
   
    //credentials
    $email = $getAdminEmail['email'];
    $password = $getAdminEmail['password'];


    //Create instance of PHPMailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = $email;
    //Set gmail password
    $mail->Password = $password;
    //Email subject
    $mail->Subject = "Hello ".$name." Please Reset Your Password";
    //Set sender email
    $mail->setFrom($email);
    //Enable HTML
    $mail->isHTML(true);
    //Email body
    $mail->Body = "Dear <b>".$name.",</b><br><br>
    $link <br>";
    //Add recipient
    $mail->addAddress($row['email']);
    //Finally send email
    if ($mail->send()) 
    {
        $_SESSION["message"] = 'Password Reset Link Sent';
        header('Location: '.'login.php');
    }
    else
    {
        $_SESSION["message"] = 'Password Cannot Be Reset';
        header('Location: '.'login.php');
    }
    //Closing smtp connection
    $mail->smtpClose();
}
else
{
    $_SESSION["message"] = 'This email is not registered with us';
    header('Location: '.'login.php');
}
?>