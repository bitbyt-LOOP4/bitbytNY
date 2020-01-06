<?php
$page = 'bitbyt';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];


?>

 



<?php 
function get_post($con, $var) {
    return mysqli_real_escape_string($con, $_POST[$var]);
}

?>
<select class="mdb-select md-form" multiple searchable="Search here..">
  <option value="" disabled selected>Choose your country</option>
 <?php 
                    $query = "SELECT * from hubs ORDER BY postal_code";    
                    $result = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result)) {
                                $hub_id = $row['hub_id'];
                                $postal_code = $row['postal_code'];
                                $hub_name = $row['hub_name'];
                   ?>
         
      <option value="<?php echo $hub_id;?>"><?php echo $postal_code;?> <?php echo $hub_name;?></option>
      
         <?php
         }
                            ?>
</select>
 

<label class="mdb-main-label">Label example</label>
<button class="btn-save btn btn-primary btn-sm">Save</button>



<?php 
    if (isset($_POST['submit'])){
        
    if (isset($_POST['hub_id'])){
          
 //$hub_name = get_post($con, 'hub_name');
 $hub_id = get_post($con, 'hub_id');
 $kid_id = $_SESSION['user_id'];
        




$query = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$hub_id', '$kid_id')";
     $result = mysqli_query($con, $query);
            if (!$result) die (mysqli_error($con));
            else {
              
                echo "<h2 class='text-center'>Du er nu registreret på de valgte hubs</h2>";
            }

    
}
    }
    ?>
     
 

<script>
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>





<?php
die();
}
/* Hvis ikke brugeren er logget ind vil siden ikke være tilgængelig */
elseif (!isset($_SESSION['user_id'])) {
	?>
<div class="container pt-5">
    <div class=jumbotron>
        <h1>Du har ikke adgang til denne side. Venligst log ind først.</h1>
    </div>
</div>







<?php
}
require_once('includes/footer.php');
?>




<?php


if(isset($_POST["framework"]))
{
 $framework = '';
 foreach($_POST["framework"] as $row)
 {
  $framework .= $row . ', ';
 }
 $framework = substr($framework, 0, -2);
 $query = "INSERT INTO like_table(framework) VALUES('".$framework."')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
