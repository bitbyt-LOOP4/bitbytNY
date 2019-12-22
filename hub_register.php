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

<div class="container pt-5">
    <h2 align="center">Hubs</h2>
    <br /><br />
    <form method="post" id="hub_id_form" enctype="multipart/form-data">
        <div class="form-group">
            <label>Vælg de hubs som du ønsker at benytte</label><br>
            <select name="hub1[]" id="hub_post" data-title="Hubs" class="selectpicker" multiple data-live-search="true" data-selected-text-format="count" data-none-results-text='Kan ikke finde et resultat. <br> Start en ny hub nedenfor:'>
                <?php 
                    $query = "SELECT * FROM hubs ORDER BY postal_code";    
                    $result = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result)) {
                                $hub_id = $row['hub_id'];
                                $postal_code = $row['postal_code'];
                                $hub_name = $row['hub_name'];
                                
                            
                                           ?>

                <option <?php 
                                $query5 = "SELECT * FROM kid_hub
                                        WHERE kid_id = '$user_id' AND hub_id = '$hub_id'";
                                $result5 = mysqli_query($con, $query5);
                                if (!$result5) die(mysqli_error($con));
                                else {
                                    $row5 = mysqli_fetch_assoc($result5);
                                    
                                    if($row5 > 0) {echo 'selected="selected"';}
                                
                                }
                            
                        ?> value="<?php echo $hub_id;?>"><?php echo $postal_code . ' - '?> <?php echo $hub_name;?></option>

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
    <label>Kan du ikke finde din hub? Opret en ny her:</label>
    <br>





    <?php
        if (isset($_POST['hub_name']) && isset($_POST['postal_code']))  {
        $hub_name = $_POST['hub_name'];
        $postal_code = $_POST['postal_code'];
        $query = "SELECT * FROM hubs WHERE postal_code = '$postal_code' AND hub_name = '$hub_name'";
        $result = mysqli_query($con, $query);
        if (!$result) die (mysqli_error($con));
        else {
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
        ?>

    <div class="container form">
        <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <h1 class="h3 mb-3 font-weight-normal">Registrer Hub</h1>
            <label for="inputPostalcode" class="sr-only">Postnummer</label>
            <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
            <br>
            <label for="inputHub" class="sr-only">Hub navn</label>
            <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register Hub</button>
        </form>
        <?php
				echo "<p class='registered error'>Dette hub eksisterer allerede</p>";
			}
            
			else if ($rows == 0) {
				$query = "INSERT INTO hubs(hub_name, postal_code) VALUES('$hub_name', '$postal_code')";
				$result = mysqli_query($con, $query);
                if(!$result) die(mysqli_error($con));
				else {
                    
            $query3 = "SELECT * from hubs WHERE hub_name = '$hub_name' AND postal_code = '$postal_code'";    
            $result3 = mysqli_query($con, $query3);
            if (!$result3){ die(mysqli_error($con));}
            else { 
            $row3 = mysqli_fetch_assoc($result3); 
            $hub_id = $row3['hub_id'];
            $query2 = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$hub_id', '$user_id')";
            $result2 = mysqli_query($con, $query2);
                 }

            
                        
					?>
        <div class="container form">
            <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <h1 class="h3 mb-3 font-weight-normal">Registrer Hub</h1>
                <label for="inputPostalcode" class="sr-only">Postnummer</label>
                <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
                <br>
                <label for="inputHub" class="sr-only">Hub navn</label>
                <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
                <br><br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register Hub</button>
            </form>
            <?php
					echo "<p class='registered'>Hub registeret og du er det første medlem</p>";
				
                }
			}
		}
	}
        else {
            ?>
            <div class="container form">
                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <h1 class="h3 mb-3 font-weight-normal">Registrer Hub</h1>
                    <label for="inputPostalcode" class="sr-only">Postnummer</label>
                    <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
                    <br>
                    <label for="inputHub" class="sr-only">Hub navn</label>
                    <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
                    <br><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Register Hub</button>
                </form>

                <?php
        }
        ?>



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
