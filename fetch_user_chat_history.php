<?php
if(!isset($_SESSION)) session_start();
require_once("conn.php");
if(!isset($_SESSION['user_id']))
{
 header("location:user-log-in.php");
}

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $con);

?>