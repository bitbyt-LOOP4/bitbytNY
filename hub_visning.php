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

<div class="container">
    <h2 align="center">Hubs</h2>
    <br /><br />
    <form method="post" id="hub_id_form" enctype="multipart/form-data">
        <div class="form-group">
            <label>Vælg de hubs som du ønsker at benytte</label>
            <select name="hub1[]" id="hub_post" placeholder="Hubs" class="selectpicker" multiple data-live-search="true" data-selected-text-format="placeholder">
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
            <!--  <input type="hidden" name="hub_id[]" value="<?php echo $hub_id ?>" />-->


        </div>
        <button class="btn btn-primary" name="submit" type="submit">Upload</button>
        <!--<div class="form-group">
     <input type="submit" class="btn btn-info view_data" name="submit" value="Submit" />
    </div>-->
    </form>
    <br>
</div>


<?php
 if(isset($_POST["hub1"])){
 $hubsid = $_POST['hub1'];
    //echo $hubsid;
    for($i = 0; $i < count($hubsid); $i++){
        $query = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$hubsid[$i]', '$user_id')";
         $result = mysqli_query($con, $query);
        
        if(!$result) die(mysqli_error($con));
        // else {
           //  echo 'Du er nu registreret på de valgte hubs';
        // }
    }
 }

      /*                          
                                
                                
                                
                                if(isset($_POST["hub_post"]))
{
  foreach($_REQUEST['hub_post'] as $row)
 {
 $query = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$row', '$user_id')"; 
 }                               
                              
 if(mysqli_query($con, $query))
 {
  echo 'Data Inserted';
 }
} */
?>


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
