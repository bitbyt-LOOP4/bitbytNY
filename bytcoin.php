<?php 
$page='bitbyt.dk';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
?>

<?php 
if (isset($_POST["bytcoin"])){
    $bytcoin = $_POST['bytcoin'];
    
    
    $query = "SELECT bytcoin FROM kid_info WHERE kid_id = '$user_id'";
    $result = mysqli_query($con, $query);
    if (!$result) die(mysqli_error($con));

    else {
        $row = mysqli_fetch_assoc($result);
        $bytcoin1 = $row['bytcoin'];

    
        $query1 = "UPDATE kid_info 
                    SET bytcoin = '$bytcoin' + '$bytcoin1'
                    WHERE kid_id = '$user_id'";
        
      
        $result = mysqli_query($con, $query1);
        if (!$result) die (mysqli_error($con));
        else {
            echo "Dine coins er nu overført";
        }
       
    }
}




?>



<header class="text-center p-3 mt-3">
    <h1>Bytcoin</h1>
</header>

<div class="container pt-3">
<form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    
                <label for="validationCustom01">Bytcoins</label>
                <input type="number" class="form-control" id="validationCustom02" placeholder="100" name="bytcoin" required>
<br>            
        <div class="row">

            <div class="col-12 text-center">
                <button class="btn btn-primary" name="submit" type="submit">Tilføj Bytcoins</button>
            </div>

        </div>

    </form>
</div>
<br>
<br>


<?php 
function get_post($con, $var) {
    return mysqli_real_escape_string($con, $_POST[$var]);
}
?>

<?php
require_once('includes/footer.php');
    ?>



<?php
die();
}
/* Hvis ikke brugeren er logget ind vil siden ikke være tilgængelig */
elseif (!isset($_SESSION['user_id'])) {
	?>
<div class="container py-5">
    <div class=jumbotron>
        <h1>Du har ikke adgang til denne side. Venligst log ind først.</h1>
    </div>
</div>


<?php
}
require_once('includes/footer.php');
die();
?>