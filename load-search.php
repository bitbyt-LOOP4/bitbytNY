<?php
$user_id = '$_POST["user_id"]';
?>
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
        <div class="col-md-4 col-lg-3 feed-card pb-4 view_data" id="<?php  echo $row['product_id']?>">
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

    ?>



    </div>
</div>


    
       

