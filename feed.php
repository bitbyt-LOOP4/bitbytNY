<?php
include_once './includes/header.php';

$con = mysqli_connect("localhost", "root", "Mikkelsen", "bitbyt");


?>

    <!-- container der indeholder artikler -->
    <div class="container">
        <div class="row">
            <!-- LOOP der genere artikler -->
            <?php
         
            
            
              $query = "SELECT * FROM `product` ORDER BY RAND() LIMIT 30";
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else ($rows = mysqli_num_rows($result));

            
            
            
            
           	 if ($rows > 0) { 
		while($row = mysqli_fetch_array($result)) {
			$product_name = $row['product_name'];
			$description = $row['description'];
			$image_link = $row['image_link'];
			$price = $row['price'];
           /* echo "<br>";
			echo "NAVN:";
            echo $product_name;
            echo "<br>";
            echo "BESKRIVELSE:";
            echo $description;
            echo "<br>";
            echo "BILLEDE LINK:";
            echo $image_link;
            echo "<br>";
            echo "PRIS:";
            echo $price; */
            echo '<div class="col-md-4 col-lg-3">';
            echo '<div class="card mb-4 shadow-sm">';
            
            echo "<h4> $product_name </h4>";

            echo '<img src="';
            echo "$image_link";
            echo ' "class="bd-placeholder-img card-img-top" width="100%" height="225" alt="test">';
            echo '<div class="card-body">';
            echo '<p class="card-text">';
            echo "$description"; 
            echo '</p>';
            echo '<div class="d-flex justify-content-between align-items-center">';
            echo '<div class="btn-group">';
            echo '<button type="button" class="btn btn-sm btn-outline-secondary " data-toggle="modal" data-target="#myModal">Se vare</button>';
            echo '</div>';
            echo '<small class="text-muted">AUH-HUB</small>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            
        }
    } 

    ?>


           
        </div>
          <button type="submit" class=" align-self-end btn btn-primary btn-block" onClick="window.location.reload();">Indlæs flere..</button>
    </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title text-left">Blandet LEGO</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          <img src="./images/lego.jpg" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="Lego">
        <p>#LEGO #Blandet #Farver #Kreativ</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-block">Anmod om byttehandel</button>
      </div>
    </div>

  </div>
</div>

  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>