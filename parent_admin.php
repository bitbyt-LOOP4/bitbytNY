<?php                                                   // Jesper & Oliver
    $page='Forældre adminstration';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id']; 
    ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">

    <?php 
           $barn1 = "SELECT * FROM `kid_info`
                            JOIN `parent` ON parent.kid_id = kid_info.kid_id OR parent.kid_id2 = kid_info.kid_id
                            JOIN `kid` ON kid.user_id = kid_info.kid_id
                    WHERE parent.parent_id = '$parent_id'";
    $result1 = mysqli_query($con, $barn1);
        
    if (!$result1) die(mysqli_error($con));
    else ($rows1 = mysqli_num_rows($result1));
        
        if ($rows1 > 0) {
            while ($row1 = mysqli_fetch_array($result1)) {
                $fornavn = $row1['first_name'];
                $efternavn1 = $row1['last_name'];
                $alder1 = $row1['age'];
                $username1 = $row1['username'];
                ?>
    <div class="container-fluid px-0 pb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-0 mb-3 border-bottom">
            <h1><?php echo $fornavn . ' ' . $efternavn1 ?></h1>
        </div>

        <div class="container-fluid px-0">
            <p>Her kan du se hvad dit barn har til salg</p>
            <!-- Byttegodkendelse ------------------------------------------>
            <!-- container der indeholder artikler -->
            <div class="container">
                <div class="row">
                    <!-- LOOP der genere artikler -->
                    <?php
                   
              $query = "SELECT * FROM `product`
                        JOIN `parent` ON product.kid_id = parent.kid_id
                        WHERE parent_id = '$parent_id'";
        
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
                                    url: "popup.php",
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



        </div>

    </div>


    <?php
            }
        }
        ?>
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
