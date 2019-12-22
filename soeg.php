<?php
$page = 'bitbyt';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
    
    
    if (isset($_POST["submit"])) {
        $product_id_1 = $_POST['product_id_1'];
        $product_id_2 = $_POST['product_id_2'];
        
        $query = "INSERT INTO transactions(product1_id, product2_id) VALUES('$product_id_1', '$product_id_2')";
        $result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
    }

  
    
    
?>
<!-- Simon -->
<!-- Feed som viser hvad andre tilbyder dig i bytte for en af dine ting ------->


<!-- Feed som viser random artikler ------------------------------>



    <!-- Search form -->
    <form class="form-inline md-form form-sm mt-0 bar">
  <i class="fas fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
    aria-label="Search" >
        <button class="sub">sss</button>
</form>
    
    
    
    
    



            <div id="search_result">
            </div>



<div id="dataModal" class="modal fade">
    <div class="modal-dialog" id="product_detail">
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log("ready!");
        $('.view_data').click(function() {
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


    $(document).ready(function() {
        console.log("ready!");
        $('.sub').click(function() {
            var search = $(this).attr("bar");
            var user_id = $(this).attr("user");
            $.ajax({
                url: "load-search.php",
                method: "post",
                data: {
                    search: search
                    user_id: user_id
                },
                success: function(data) {
                    $('#search_result').html(data);
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