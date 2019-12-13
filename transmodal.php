<?php 


 if(isset($_POST["product_id"]))  
 {  
      require_once('conn.php');  
     $query = "SELECT * FROM product WHERE product_id = '".$_POST["product_id"]."'";  

      $result = mysqli_query($con, $query);  

      while($row = mysqli_fetch_array($result))  
      {  
            $product_name = $row['product_name'];
			$description = $row['description'];
			$image_link = $row['image_link'];
			$price = $row['price'];
            $product_id = $row['product_id'];
          ?>
    <form method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-left"> Bytteforslag </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="container">
    <div class="row">
        <div class="modal-body">
            <h3>Amoders vare:</h3>
            <h4><?php echo $product_name?></h4>
            <img src="<?php echo $image_link?>" class="bd-placeholder-img card-img-top modal-popup mb-1" alt="Lego">
            <p><?php echo $description?></p>

            <h3>Din vare:</h3>
            <h4><?php echo $product_name?></h4>
            <img src="<?php echo $image_link?>" class="bd-placeholder-img card-img-top modal-popup mb-1" alt="Lego">
            <p><?php echo $description?></p>

        </div>
            </div>
        </div>
        <div class="modal-footer">

           

            <button type="submit" name="godkendtsubmit" class="btn btn-success btn-block">Godkend</button>
            <button type="submit" name="afvissubmit" class="btn btn-danger btn-block">Afvis</button>
        </div>
    </div>

    <?php  
      }  
 }
 ?>
</form>
