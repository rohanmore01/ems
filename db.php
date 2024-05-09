<?php
$serverName = 'localhost';
$userName = 'root';
$password = 'Nic@123';
$dbName = "ems";
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$conn) {
    die('Cannot connect to mysql Database' . mysql_error());
}
