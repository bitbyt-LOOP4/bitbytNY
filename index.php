<?php                                                                                     //Jesper & Oliver & Simon
$page='bitbyt.dk';
require_once('includes/header.php');
if(isset($_SESSION['user_id'])) {
    header('Location: feed.php');
}
?>
<!-- Der er to velkommen, men kun den ene bliver vist. Er på grund af at margenerne skal være lidt forskellige på mobil og desktop -->
<div class="velkommen bg-bitbyt">
    <div class="container-fluid d-none d-md-block pb-0 pt-5 pl-2">
        <h1 class="display-5 pl-4 text-light">Velkommen til børnenes <br> bytteportal</h1>
        <h1 class="display-5 purple-bitbyt pb-4 pl-4 m-0">Hvor alle dine ting kan <br> byttes</h1>
    </div>
    <div class="container-fluid d-md-none pb-0 pt-5 pl-2">
        <h1 class="display-5 text-light">Velkommen til børnenes <br> bytteportal</h1>
        <h1 class="display-5 purple-bitbyt pb-4">Hvor alle dine ting kan byttes</h1>
    </div>
</div>

<!-- Alle ikoner er hentet med frie rettigheder fra flaticon.com igennem subscription ------------->
<div class="jumbotron jumbotron-fluid bg-bitbyt-purple mb-0 text-light">
    <div class="container">
        <h1 class="display-5 pb-3">Sådan gør du!</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-xl-3 text-center">
                <img class="icon_index" src="images/photo-camera.svg">
                <h6 class="mt-4 mb-4">1. Upload billeder af det du vil bytte med</h6>
            </div>
            <div class="col-12 col-md-6 col-xl-3 text-center">
                <img class="icon_index" src="images/toys-icon.svg">
                <h6 class="mt-4 mb-4">2. Find noget du gerne vil have</h6>
            </div>
            <div class="col-12 col-md-6 col-xl-3 text-center">
                <img class="icon_index" src="images/chat-icon.svg">
                <h6 class="mt-4 mb-4">3. Anmod om byttehandel</h6>
            </div>
            <div class="col-12 col-md-6 col-xl-3 text-center">
                <img class="icon_index" src="images/exchange-icon.svg">
                <h6 class="mt-4 mb-4">4. Byt!</h6>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron jumbotron-fluid mb-0">
    <div class="container">
        <h1 class="display-5">Hvad andre bytter væk</h1>
        <div class="row mt-3">
            <!-- LOOP der generere artikler -->
            <?php
                    
              $query = "SELECT * FROM `product` ORDER BY RAND() LIMIT 4";
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
            <div class="col-md-6 col-lg-3 feed-card pb-4">
                <div class="card mb-4 shadow-sm h-100">

                    <h4 class="m-2 text-truncate"> <?php echo $product_name?> </h4>

                    <img src="<?php echo $image_link;?> " class="bd-placeholder-img card-img-top" width="100%" height="225" alt="test">
                    <div class="card-body">
                        <p class="card-text text-truncate">
                            <?php echo $description ?>

                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary view_data" id="<?php  echo $row['product_id']?>">Se vare</button>

                            </div>
                            <small class="text-muted">Rørkjær Skole</small>


                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }
    } 
    ?>

        </div>
        <button type="submit" class="align-self-end btn text-light bg-bitbyt-secondary btn-bredde" onClick="window.location.reload();">Indlæs flere..</button>
    </div>

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



<?php 
require_once('includes/footer.php');
?>
