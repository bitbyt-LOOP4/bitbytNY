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
$con->set_charset("utf8mb4");
date_default_timezone_set('Europe/Copenhagen');

function fetch_user_last_activity($user_id, $con)
{
	$query = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC  LIMIT 1";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$last_activity = $row['last_activity'];
				return $last_activity;
			}
		}
	}
}

function fetch_user_chat_history($from_user_id, $to_user_id, $con)
{
	$query = "SELECT * FROM chat_message WHERE (from_user_id = '$from_user_id' AND to_user_id = '$to_user_id') OR (from_user_id = '$to_user_id' AND to_user_id = '$from_user_id') ORDER BY timestamp DESC";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo '<ul class="list-unstyled">';
				$user_name = '';
				if($row["from_user_id"] == $from_user_id) {
					$user_name = '<b class="text-success">You</b>';
				}
				else {
					$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $con).'</b>';
				}
				echo '<li style="border-bottom:1px dotted #ccc">';
				echo '<p>'. $user_name . ' - ' . $row["chat_message"];
				echo '<div align="right"> - <small><em>' . $row['timestamp'] . '</em></small>';
				echo '</div></p></li>';
			}
			echo '</ul>';
			$query2 = "UPDATE chat_message SET status = '0' WHERE from_user_id = '$to_user_id' AND to_user_id = '$from_user_id' AND status = '1'";
			$result2 = mysqli_query($con, $query2);
			if (!$result2) die(mysqli_error($con));
		}
	}
}
  

function get_user_name($user_id, $con) {
	$query = "SELECT username FROM kid WHERE user_id = '$user_id'";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$username = $row['username'];
				return $username;
			}
		}
	}
}
function count_unseen_message($from_user_id, $to_user_id, $con) {
	$query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			$output = '<span class="alert alert-success">'. $rows .'</span>';
			return $output;
		}
		
	}
}

function fetch_is_type_status($user_id, $con) {
	$query = "SELECT is_type FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	if (!$result) die (mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$is_type = $row['is_type'];
				if ($is_type == '1') {
					$typing = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
					return $typing;
				}
					
			}
				
		}
	}
}
?>