<?php
include "header.php";
$_SESSION["message"] = 'You have logout Successfully';
unset($_SESSION["id"]);
unset($_SESSION["user_type"]);
unset($_SESSION["emp_id"]);
unset($_SESSION["first_name"]);
unset($_SESSION["last_name"]);
unset($_SESSION["encoded_photo"]);
unset($_SESSION["designation"]);
unset($_SESSION["code_confirmation"]);

header('Location: '.'login.php');