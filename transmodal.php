<?php 

   
 if(isset($_POST["product_id"]))  
 {  
     ?>
        
     <?php
      require_once('conn.php');  
     $query = "SELECT * FROM transactions WHERE trans_id = '".$_POST["product_id"]."'";
           $result = mysqli_query($con, $query);  

      while($row = mysqli_fetch_array($result))  
      {  
            $product1_id = $row['product1_id'];
			$product2_id = $row['product2_id'];

     
     
     
     $query = "SELECT * FROM product WHERE product_id = '$product1_id'";  

      $result = mysqli_query($con, $query);  

      while($row = mysqli_fetch_array($result))  
      {  
            $product_name = $row['product_name'];
			$description = $row['description'];
			$image_link = $row['image_link'];
			$price = $row['price'];
            $product_id = $row['product_id'];
   

          
          
          
     $query1 = "SELECT * FROM product WHERE product_id = '$product2_id'";  

      $result1 = mysqli_query($con, $query1);  

      while($row = mysqli_fetch_array($result1))  
      {  
            $product1_name = $row['product_name'];
			$description1 = $row['description'];
			$image1_link = $row['image_link'];
			$price1 = $row['price'];
            $product1_id = $row['product_id'];






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
            <div Class="container">
                <div class="row">
                    <div class="col-md-5">
            <h3>Amoders vare:</h3>
            <h4><?php echo $product_name?></h4>
            <img src="<?php echo $image_link?>" class="bd-placeholder-img card-img-top modal-popup mb-1" alt="Lego">
            <p><?php echo $description?></p>
            </div>
             
                    
             <i class="fas fa-exchange-alt col-md-2"></i>       
              
                    
            <div class="col-md-5">
            <h3>Din vare:</h3>
            <h4><?php echo $product1_name?></h4>
            <img src="<?php echo $image1_link?>" class="bd-placeholder-img card-img-top modal-popup mb-1" alt="Lego">
            <p><?php echo $description1?></p>
            </div>
            </div>
        </div>
            </div>
        </div>
        <div class="modal-footer">

           
            <input type="hidden" name="trans_id" value="<?php echo $_POST["product_id"] ?>" />
            <button type="submit" name="godkendtsubmit" class="btn btn-success btn-block">Godkend</button>
            <button type="submit" name="afvissubmit" class="btn btn-danger btn-block">Afvis</button>
        </div>
    </div>

    <?php 
      }
      }  
      }
 }
 ?>
</form>
