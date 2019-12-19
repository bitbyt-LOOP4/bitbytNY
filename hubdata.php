<?php
$page = 'bitbyt';
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
print_r();  
    echo "hertil";
    

if(isset($_POST["hub_id"]))
{
   
    $hub_id = $_POST["hub_id"];
    echo $hub_id;
 
 $hub_id = '';
 foreach($_POST["hub_id"] as $row)
 {
  $hub_name .= $row . ', ';
 }
 $hub_name = substr($hub_name, 0, -2);
 $query = "INSERT INTO kid_hub(kid_id, hub_id) VALUES('".$hub_id."')";
 if(mysqli_query($con, $query))
 {
  echo 'Data Inserted';
 }
}
}
?>
