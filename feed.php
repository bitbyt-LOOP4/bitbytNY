<?php
$page = 'bitbyt';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
    
    
    if (isset($_POST["submit"])) {
        $product_id_1 = $_POST['product_id_1'];
        $product_id_2 = $_POST['product_id_2'];
        
        $query1 = mysqli_query($con, "SELECT * FROM `product` WHERE product_id = '$product_id_1'");
        $row1 = mysqli_fetch_assoc($query1);
        $kid_id_1 = $row1['kid_id'];
        
        
        $query2 = mysqli_query($con, "SELECT * FROM `product` WHERE product_id = '$product_id_2'");
        $row2 = mysqli_fetch_assoc($query2);
        $kid_id_2 = $row2['kid_id'];
        
        /*$query2 = "SELECT kid_id FROM `product`
                    WHERE product_id = '$product_id_1'";
        
        $result2 = mysqli_query($con, $query2);  
        if (!$result2) die(mysqli_error($con)); 
        while($row = mysqli_fetch_array($result2))  
        {  
            $kid_id_1 = $row['kid_id'];
        }
        
        $query3 = "SELECT kid_id FROM `product`
                    WHERE product_id = '$product_id_2'";
        
        $result3 = mysqli_query($con, $query3);  
        if (!$result3) die(mysqli_error($con)); 
        while($row = mysqli_fetch_array($result2))  
        {  
            $kid_id_2 = $row['kid_id'];
        }
        */
        $query = "INSERT INTO transactions (product1_id, product2_id, kid_id_1, kid_id_2) VALUES('$product_id_1', '$product_id_2', '$kid_id_1', $kid_id_2)";
        $result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
    }
    if (isset($_POST["godkendtsubmit"])) {
        $trans_id = $_POST["trans_id"];
           $query = "UPDATE transactions 
                      SET kid_approve = '1'  
                      WHERE trans_id = '$trans_id'";
            $result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con)); 
        
    }
    
    if (isset($_POST["afvissubmit"])) {
        $trans_id = $_POST["trans_id"];
        $query = "UPDATE transactions 
                      SET kid_approve = '2'  
                      WHERE trans_id = '$trans_id'";
            $result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
    }
?>

<!-- Simon -->
<!-- Feed som viser hvad andre tilbyder dig i bytte for en af dine ting ------->

<!-- container der indeholder bytteanmodninger -->
<div class="container">
    <div class="row">
        <!-- LOOP der genere bytteanmodninger -->
        <?php
               // Går ind i databasen og henter produkter fra vedkommende som har anmodet om et byt    
             $query = "SELECT * FROM `product` Offer
                            JOIN `transactions` T ON Offer.product_id = T.product2_id
                            JOIN `product` Tilbud ON Tilbud.product_id = T.product1_id
                        WHERE Offer.kid_id = '$user_id' AND kid_approve='0'"; 
                     

    
    
        
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else ($rows = mysqli_num_rows($result));

                     
           	 if ($rows > 0) { 
                 ?>

        <header class="container p-5 d-none d-md-block">
            <h1 class="display-4">Det tilbyder andre dig</h1>
        </header>
        <header class="container-fluid pb-5 pt-4 d-md-none">
            <h1 class="display-5">Det tilbyder andre dig</h1>
        </header>



        <?php         
                while($row = mysqli_fetch_array($result)) {
                    $product_name = $row['product_name'];
                    $description = $row['description'];
                    $image_link = $row['image_link'];
                    $price = $row['price'];
                    $product_id = $row['product_id'];
                    $trans_id = $row['trans_id'];
                    
        ?>


        <div class="col-md-4 col-lg-3 feed-card pb-4">
            <a class="card mb-4 shadow-sm view_trans" id="<?php  echo $row['trans_id']?>">

                <h4 class="m-2 text-truncate"> <?php echo $product_name?> </h4>

                <img src="<?php echo $image_link;?> " class="bd-placeholder-img card-img-top" width="100%" height="225" alt="test">
                <div class="card-body">
                    <p class="card-text text-truncate">
                        <?php echo $description ?>


                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary view_trans" id="<?php  echo $row['trans_id']?>">Se Anmodning</button>

                        </div>
                        <small class=" text-muted">Herning Spejderne</small>


                    </div>
                </div>
            </a>
        </div>
        <?php 
        }
    } 
    ?>

        <div id="transModal" class="modal fade ">
            <div class="modal-dialog modal-xl" id="trans_detail">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log("ready!");
        $('.view_trans').click(function() {
            var product_id = $(this).attr("id");
            $.ajax({
                url: "transmodal.php",
                method: "post",
                data: {
                    product_id: product_id
                },
                success: function(data) {
                    $('#trans_detail').html(data);
                    $('#transModal').modal("show");
                }
            });
        });
    });

</script>
<br>
<hr>
<!-- Feed som viser random artikler ------------------------------>
<header class="container p-5 d-none d-md-block">
    <h1 class="display-4">Hvad kunne du tænke dig?</h1>
</header>
<header class="container-fluid pb-5 pt-4 d-md-none">
    <h1 class="display-5">Hvad kunne du tænke dig?</h1>
</header>


<!-- container der indeholder artikler -->
<div class="container">
    <div class="row">
        <!-- LOOP der genere artikler -->
        <?php
                    
              $query = "SELECT * FROM `product` WHERE kid_id != '$user_id' ORDER BY RAND() LIMIT 30";
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
?>
        <a class="col-md-4 col-lg-3 feed-card pb-4 data_view" id="<?php  echo $row['product_id']?>" user="<?php  echo $user_id?>">
            <div class="card mb-4 shadow-sm h-100">

                <h4 class="m-2 text-truncate"> <?php echo $product_name?> </h4>

                <img src="<?php echo $image_link;?> " class="bd-placeholder-img card-img-top" width="100%" height="225" alt="test">
                <div class="card-body">
                    <p class="card-text text-truncate">
                        <?php echo $description ?>

                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">

                            <button type="button" class="btn btn-sm btn-outline-secondary data_view" user="<?php  echo $user_id?>" id="<?php  echo $row['product_id']?>">Se vare</button>

                        </div>
                        <small class=" text-muted">Rørkjær Skole</small>

                    </div>
                </div>
            </div>
        </a>
        <?php 
        }
    } 

    ?>



    </div>
    <div class="container pt-3 pb-5">
        <button type="submit" class="align-self-end btn text-light bg-bitbyt-secondary btn-bredde" onClick="window.location.reload();">Indlæs flere..</button>
    </div>
</div>

<div id="dataModal" class="modal fade">
    <div class="modal-dialog" id="product_detail">
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log("ready!");
        $('.data_view').click(function() {
            var user_id = $(this).attr("user");
            var product_id = $(this).attr("id");
            $.ajax({
                url: "popup.php",
                method: "post",

                data: {
                    product_id: product_id,
                    user_id: user_id
                },
                success: function(data) {
                    $('#product_detail').html(data);
                    $('#dataModal').modal("show");
                }
            });
        });
    });

</script>

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
