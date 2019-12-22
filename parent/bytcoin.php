<?php                                                   // Jesper & Oliver
    $page='Forældre adminstration';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id']; 
    ?>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
    <?php 
if (isset($_POST["bytcoin"])){
    $bytcoin = $_POST['bytcoin'];
    
    
    $query = "SELECT * FROM kid_info 
                JOIN parent ON parent.kid_id = kid_info.kid_id
                WHERE parent.parent_id = '$parent_id'";
    $result = mysqli_query($con, $query);
    if (!$result) die(mysqli_error($con));

    else {
        $row = mysqli_fetch_assoc($result);
        $bytcoin1 = $row['bytcoin'];
        $user_id = $row['kid_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

    
        $query1 = "UPDATE kid_info 
                    SET bytcoin = '$bytcoin' + '$bytcoin1'
                    WHERE kid_id = '$user_id'";
        $result = mysqli_query($con, $query1);
        if (!$result) {  die (mysqli_error($con));  
            echo "FEJL";
             }
            
        else  
            echo "Du har nu overført " . $bytcoin . " Bytcoins!" . "<br>" . $first_name . " " . $last_name . " har nu " . ($bytcoin+$bytcoin1) . " Coins! ";

       
    }
}




?>



    <div class="container-fluid row px-0 pb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-0 mb-3 border-bottom col-12">
            <h1>Køb Bytcoins</h1>
        </div>


        <div class="pt-3 col-12 col-md-3">
            <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                <label for="validationCustom01">Bytcoins</label>
                <input type="number" class="form_bytcoins form-control" id="validationCustom02" placeholder="100" name="bytcoin" required>
                <br>
                <div class="row">

                    <div class="col-12 text-left">
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
    </div>
</main>
<?php require_once('includes/footer_parent.php') ?>

<?php 
    die();
    }
elseif (!isset($_SESSION['parent_id'])) {
	?>
<div class="container px-5 py-5">
    <div class=jumbotron>
        <h2>Du har ikke adgang til denne side. Venligst <a href="parent-login.php">log ind</a> først.</h2>
    </div>
</div>


<?php
}
require_once('includes/footer_parent.php');
die();
?>
