<?php
if(!isset($_SESSION)) session_start();
require_once("conn.php");
require_once('includes/header.php');
if(!isset($_SESSION['user_id'])) {
	header("location:user-log-in.php");
}
else {
	$query = "UPDATE login_details SET last_activity = NOW() WHERE login_details_id = '".$_SESSION["login_details_id"]."'";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
}
?>