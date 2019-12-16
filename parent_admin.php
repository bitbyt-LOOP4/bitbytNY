<?php                                                   // Jesper & Oliver
    $page='Forældre adminstration';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id'];} 
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
                    <header class="container-fluid pb-5 pt-4 d-sm-none">
                        <h1 class="display-6">Det tilbyder andre dig</h1>
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


                    <div class="col-lg-3">
                        <div class="card mb-4 shadow-sm">

                            <h4> <?php echo $product_name?> </h4>

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
                        </div>
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




            <div>

            </div>
        </div>

    </div>


    <?php
            }
        }
        ?>
</main>

<?php 
require_once('includes/footer_parent.php')
    ?>
