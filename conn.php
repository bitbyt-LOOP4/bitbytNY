<?php
if (!isset($_SESSION)) session_start();
ob_start();
require_once("login.php");
//Create the connection
$con = mysqli_connect($host, $username, $password, $database);
//Fixes the problem displaying special characters
mysqli_set_charset($con, 'utf8');
//Check the connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
} 
?>