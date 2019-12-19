<?php

$page = 'Oprettelse af legetøj';
require_once('includes/header.php');
$user_id = $_SESSION['user_id'];
?>

<?php
if (isset($_POST['msg'])){
      $msg = get_post($con, 'msg');
    $query1 = "SELECT `username` FROM `kid` WHERE `user_id` = '$user_id'"; 
    $result = mysqli_query($con, $query1);
    if (!$result) die(mysqli_error($con));
        else 
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
    $query = "INSERT INTO chat_message(msg,username)
         VALUES('$msg', '$username')";
         
         $result = mysqli_query($con, $query);
         
         if(!$result) 
             die(mysqli_error($con));
    
}

?>

<header class="text-center p-3 mt-3">
    <h1>Beskeder</h1>
</header>



<form novalidate method="post" method="post" enctype="multipart/form-data">

    <div class="row">
                             

        <div class="col-12 container-fluid">
            <!--skriv username på den anden bruger-->
                 <div class="modal-dialog">

            <div class="card col-md">
             <div class="card-body">
            

                <?php 
                $query = "SELECT `username` FROM `kid` WHERE `user_id` = '$user_id'"; 
                    $query1 = "SELECT * FROM chat_message";     
                $result = mysqli_query($con, $query1);
                if ($result->num_rows > 0){     
                while($row = $result->fetch_assoc()) {
                  echo "" . $row["username"]. " " .":: " . $row["msg"]." --" .$row["timestamp"]. "<br>"; 
                                
                }}
                    
                    
                            ?>





          
             </div>
             </div>
</div>
            
                <div class="input-group col-4-ml-4 text-center">
                    <input type="text" class="form-control" placeholder="Skriv din besked her" id="chat_msg" name="msg">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit" id="send_msg" value="<?php echo $id; ?>">
                            <span class="glyphicon glyphicon-comment"></span> Send
                        </button>
                    </span>
                </div>

            </div>
        





    </div>



</form>

<?php 
function get_post($con, $var) {
    return mysqli_real_escape_string($con, $_POST[$var]);
}

?>

<?php
require_once('includes/footer.php');
?>
