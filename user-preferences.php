<?php
include "db.php";
session_start();

if($_POST['key'] == 'sidebar_skins')
{
  mysqli_query($conn, "UPDATE `user_preferences` SET `sidebar_skins`='" .  $_POST["sideBarColor"] . "' WHERE `user_id`='" .  $_SESSION["id"] . "' ");
}

if($_POST['key'] == 'header_skins')
{
  mysqli_query($conn, "UPDATE `user_preferences` SET `header_skins`='" .  $_POST["navBarColor"] . "' WHERE `user_id`='" .  $_SESSION["id"] . "' ");
}

if($_POST['key'] == 'sidebar_minimize')
{
  mysqli_query($conn, "UPDATE `user_preferences` SET `minimize_sidebar`='" .  $_POST["sideBarMinimizeClass"] . "' WHERE `user_id`='" .  $_SESSION["id"] . "' ");
}

?>