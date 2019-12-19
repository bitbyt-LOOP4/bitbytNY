<?php
if(!isset($_SESSION)) session_start();
require_once('includes/header.php');
require_once("conn.php");
if(!isset($_SESSION['user_id'])) {
	header("location:user-log-in.php");
}
else {
	$query = "UPDATE login_details SET is_type = '".$_POST["is_type"]."' WHERE login_details_id = '".$_SESSION["login_details_id"]."'";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
}
?>