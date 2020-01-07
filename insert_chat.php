<?php
require_once('conn.php');
//require_once('includes/header.php');
if(!isset($_SESSION['user_id']))
{
 header("location:user-log-in.php");
}
$data = array(
	$to_user_id  = $_POST['to_user_id'],
	$from_user_id  = $_SESSION['user_id'],
	$chat_message  = mysqli_real_escape_string($con, ($_POST['chat_message'])),
	$status  = '1'
);

$query = "INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) VALUES('$to_user_id', '$from_user_id', '$chat_message', '$status')";
$result = mysqli_query($con, $query);
if (!$result) die(mysqli_error($con));
else {
 echo fetch_user_chat_history($from_user_id, $to_user_id, $con);
}

?>
?>
