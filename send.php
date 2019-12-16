<?php
$page = 'Send';
require_once('includes/header.php');
?>
<?php

    $msg=$_POST['msg'];
    $user_id=$_SESSION['user_id'];

    $query = "SELECT `username` FROM `kid` WHERE `user_id` = '$user_id'"; 
    $result = mysqli_query($con, $query);
    if (!$result) die(mysqli_error($con));
        else 
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];

//$query1="SELECT * FROM `posts` WHERE user_id != '$username'";


$query="INSERT INTO posts(msg, username) VALUES('$msg', '$username')";
$result = mysqli_query($con, $query);

 if (!$result){
        echo "MySQL Error: " . mysqli_error($con);
        require_once ('includes/footer.php');
        die();  
    } 
    else {
         header('Location: chat.php');
    }


?>

