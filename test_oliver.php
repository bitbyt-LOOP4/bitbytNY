<?php
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
   
    if (isset($_SESSION['user_id'])){ 
    $query = "SELECT bytcoin 
              FROM kid_info 
              WHERE kid_id = '$user_id'";
        $result = mysqli_query($con, $query);
        if (!$result) die(mysqli_error($con));
            
        else 
            $row = mysqli_fetch_assoc($result);
            $bytcoin = $row['bytcoin'];
        } 
        ?>