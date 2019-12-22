<?php                                                   // Jesper & Oliver
$page='Min profil';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
 
// Variabel der går ind og tæller hvor mange opslag du har i databasen
$num_q = "SELECT COUNT(*) AS 'antal' FROM product
          WHERE kid_id = '$user_id'";
$result = mysqli_query($con, $num_q);
if (!$result) die(mysqli_error($con));

    else 
        $row = mysqli_fetch_assoc($result);
        $number_prod = $row['antal'];

// Variabel der går ind og tæller hvor mange byttehandler du har i databasen
$trade_q = "SELECT COUNT(*) AS 'byttehandler' FROM `product` Tilbud
            JOIN `transactions` T ON Tilbud.product_id = T.product1_id
            JOIN `product` Offer ON Offer.product_id = T.product2_id
        WHERE Offer.kid_id = '$user_id'";
    
$result = mysqli_query($con, $trade_q);
if (!$result) die(mysqli_error($con));

    else 
        $row = mysqli_fetch_assoc($result);
        $number_trade = $row['byttehandler'];

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 profil_container"></div>
        <div class="col-8 profil_container">
            <div class="text-center">
                <!-- Midlertidig løsning til Avatar. Endelige avatars skal være med mulighed for at vælge i mellem forskellige ikonet er hentet uden copyright fra flaticons.com-->
                <img class="avatar" src="images/ninja.svg">

                <!-- Brugernavn hentes via PHP -->
                <h2 class="profil_brugernavn mt-3">

                    <?php    
                        $query = "SELECT `username` FROM `kid` WHERE `user_id` = '$user_id'"; 
                        $result = mysqli_query($con, $query);
                        if (!$result) die(mysqli_error($con));
                            else 
                                $row = mysqli_fetch_assoc($result);
                                $username = $row['username'];
                                echo $username;
                    ?>

                </h2>

                <div class="list-group text-right">
                    <!-- Dette er blot designmæssigt. Ingen funktionalitet på nuværende tidspunkt ----->
                    <div class="dropdown text-center">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i> Indstillinger </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item dropdown_items" href="#!"><i class="fab fa-hubspot"></i> Mine Hubs</a>
                            <a class="dropdown-item dropdown_items" href="#!"><i class="fas fa-user-alt"></i> Skift Avatar</a>
                            <a href="logout.php" class="dropdown-item dropdown_items"><i class="fas fa-sign-out-alt"></i> Log ud</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-2 profil_container">

        </div>

    </div>
    <br>
    <!-- variabler skal hentes med PHP-->
    <div class="row text-center">
        <div class="col-1 col-md-4"></div>
        <div class="col-3 col-md-1">
            <span class="profil_variabler">2</span>
            <br>
            <span class="under_profil">Hubs</span>
        </div>
        <div class="col-4 col-md-2">
            <span class="profil_variabler"><?php echo $number_trade ?></span>
            <br>
            <span class="under_profil">Byttehandler</span>
        </div>
        <div class="col-3 col-md-1">
            <span class="profil_variabler"><?php echo $number_prod ?></span>
            <br>
            <span class="under_profil">Opslag</span>
        </div>
        <div class="col-1 col-md-4"></div>

    </div>
</div>
<br><br>
<div class="container">
    <h1 class="display-5 text-center">Dine varer</h1>
</div>
<!-- container der indeholder artikler -->
<div class="container">
    <div class="row">
        <!-- LOOP der genere artikler -->
        <?php
                   
              $query = "SELECT * FROM `product`
                            WHERE kid_id = '$user_id'";
        
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else ($rows = mysqli_num_rows($result));
                     
           	 if ($rows > 0) { 
                while($row = mysqli_fetch_array($result)) {
                    $product_name = $row['product_name'];
                    $description = $row['description'];
                    $image_link = $row['image_link'];
                    $price = $row['price'];
                    $product_id = $row['product_id'];
                    $placeholder = '';
        ?>
        <div class="col-md-4 col-lg-3 feed-card pb-4">
            <div class="card mb-4 shadow-sm h-100">

                <h4 class="m-2 text-truncate"> <?php echo $product_name?> </h4>

                <img src="<?php echo $image_link;?> " class="bd-placeholder-img card-img-top" width="100%" height="225" alt="test">
                <div class="card-body">
                    <p class="card-text text-truncate">
                        <?php echo $description ?>

                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">

                            <button type="button" class="btn btn-sm btn-outline-secondary view_data" user="<?php  echo $user_id?>" id="<?php  echo $row['product_id']?>">Se vare</button>

                        </div>
                        <small class=" text-muted">Rørkjær Skole</small>

                    </div>
                </div>
            </div>
        </div>
        <?php 
        }
    }
    else {
        $placeholder = 'Der er ingen varer at vise';
    ?>
        <div class="col-1 col-md-3"></div>
        <div class="jumbotron text-muted text-center my-4 col-10 col-md-6">
            <p> <?php echo $placeholder ?> </p>
        </div>
        <div class="col-1 col-md-3"></div>
        <?php } ?>


        <div id="dataModal" class="modal fade">
            <div class="modal-dialog" id="product_detail">
            </div>
        </div>

        <script>
            $(document).ready(function() {
                console.log("ready!");
                $('.view_data').click(function() {
                    var product_id = $(this).attr("id");
                    $.ajax({
                        url: "vis_vare.php",
                        method: "post",
                        data: {
                            product_id: product_id
                        },
                        success: function(data) {
                            $('#product_detail').html(data);
                            $('#dataModal').modal("show");
                        }
                    });
                });
            });

        </script>
    </div>
</div>

<?php
require_once('includes/footer.php');
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

<?php
die();
?>
