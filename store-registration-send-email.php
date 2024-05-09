<?php
ini_set('display_errors', '1');
include "header.php";

//Include required PHPMailer files
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';
require 'PhpMailer/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit-registration-form']))
{
    $checkEmailInDb = mysqli_query($conn,"SELECT * FROM employees WHERE email='" . $_POST['email'] . "'");

    $row = mysqli_num_rows($checkEmailInDb);

    if($row == 0)
    {
        if($_FILES['photo']['name'] != '')
        {
            $photoName = $_FILES['photo']['name'];
            $encodedImg = chunk_split(base64_encode(file_get_contents($_FILES['photo']['tmp_name'])));
        }
        else
        {
            $photoName = "";
            $encodedImg = "";
        }

        if($_FILES['resume']['name'] != '')
        {
            $resumeName = $_FILES['resume']['name'];
            $encodedResume = chunk_split(base64_encode(file_get_contents($_FILES['resume']['tmp_name'])));
        }
        else
        {
            $resumeName = "";
            $encodedResume = "";
        }
        
        $token = md5($_POST['email']).rand(10,9999);
        $name = $_POST['first_name']." ".$_POST['last_name'];

        if(!isset($_POST['user_type']))
        {
            $_POST['user_type'] = "Normal User";
        }

        $empId = rand (1000,9999);

        $_POST['gender'] = $_POST['gender'] ?? '';
        $_SESSION['id'] = $_SESSION['id'] ?? 'guest user';

        //hash password
        $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
        $hashedPassword   = hash('sha256', $_POST['password'] . $salt);
  
        mysqli_query($conn, "INSERT INTO employees(id, emp_id, first_name, last_name, email, phone, dob, gender,qualification,experience,designation,blood_group,user_type,address, photo_name, encoded_photo, resume_name,encoded_resume, email_verification_link ,password, emergency_contact_no, emp_category, date_of_joining, skills, work_assign, created_by) VALUES(UUID(),'" . $empId . "','" . $_POST['first_name'] . "','" . $_POST['last_name'] . "', '" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['dob'] . "','" . $_POST['gender'] . "','" . $_POST['qualification'] . "','" . $_POST['experience'] . "','" . $_POST['designation'] . "','" . $_POST['blood_group'] . "','" . $_POST['user_type'] . "','" . $_POST['address'] . "','" . $photoName . "','" . $encodedImg . "', '" . $resumeName . "','" . $encodedResume . "', '" . $token . "', '" . $hashedPassword . "', '" . $_POST['emergency_contact_no'] . "', '" . $_POST['emp_category'] . "', '" . $_POST['date_of_joining'] . "','" . $_POST['skills'] . "','" . $_POST['work_assign'] . "', '" . $_SESSION['id'] . "')");

        $link = "<a href=http://".$_SERVER['HTTP_HOST']."/EMS/verify-email.php?key=".$_POST['email']."&token=".$token.">Click Here To Verify Account</a>";

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
            $mail->Subject = "EMS : Employee Account Verification Link";
            //Set sender email
            $mail->setFrom($email);
            //Enable HTML
            $mail->isHTML(true);
            //Attachment
            $mail->addAttachment($_FILES['photo']['tmp_name']);
            //Email body
            $mail->Body = "Dear <b>Sir,</b><br><br>
            The new Employee is Registered on EMS Portal.<br><br>
            <table style='border-collapse: collapse;color:green'; border=1>
            <tr>
                <th colspan=2>Employee Details</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>".$name."</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>".$_POST['email']."</td>
            </tr>
            <tr>
                <td>Phone No.</td>
                <td>".$_POST['phone']."</td>
            </tr>
            <tr>
                <td>Date Of Birth</td>
                <td>".$_POST['dob']."</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>".$_POST['gender']."</td>
            </tr>
            <tr>
                <td>Qualification</td>
                <td>".$_POST['qualification']."</td>
            </tr>
            <tr>
                <td>Experience</td>
                <td>".$_POST['experience']."</td>
            </tr>
            <tr>
                <td>Designation</td>
                <td>".$_POST['designation']."</td>
            </tr>
            <tr>
                <td>Blood Group</td>
                <td>".$_POST['blood_group']."</td>
            </tr>
            <tr>
                <td>User Type</td>
                <td>".$_POST['user_type']."</td>
            </tr>
            <tr>
                <td>Emergency Contact No.</td>
                <td>".$_POST['emergency_contact_no']."</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>".$_POST['address']."</td>
            </tr>
            </table><br>
            $link";
            //Add recipient
            $mail->addAddress($email);
            //Finally send email
            if ($mail->send()) 
            {
                echo '<span id="success" class="alert-section">
                    <p class="text-center">Employee Created Successfully. Please Tell Admin to Verify This Account.</p>
                    <i class="fa fa-times succ" aria-hidden="true"></i>
                    </span>';
            }
            else
            {
                echo '<span id="success" class="alert-section">
                    <p class="text-center">Employee Created Successfully. Please Tell Admin to Verify This Account.</p>
                    <i class="fa fa-times succ" aria-hidden="true"></i>
                    </span>';
            }
            //Closing smtp connection
            $mail->smtpClose();
    }
    else
    {
      echo '<span id="success" class="alert-section">
            <p class="text-center">You have already Registered. Please Tell Admin to Verify This Account.</p>
            <i class="fa fa-times succ" aria-hidden="true"></i>
            </span>';
    }
}
?>