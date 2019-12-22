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
            <h4 class="modal-title text-left"><?php echo $product_name?></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <img src="<?php echo $image_link?>" class="bd-placeholder-img card-img-top modal-popup" alt="Lego">
            <p><?php echo $description?></p>

        </div>
        <div class="modal-footer">

            <div class="col-md-8 mb-4"><select name="product_id_1" class="custom-select">
                    <option selected value="">Vælg en vare du vil bytte</option>
                    <?php 
                        $query = "SELECT * From product WHERE kid_id != '".$_POST["user_id"]."'";    
                        $result = mysqli_query($con, $query);
                        $rows = mysqli_num_rows($result);
                            
                                while($row1 = mysqli_fetch_assoc($result)) {
                                    $product1_id = $row1['product_id'];
                                    $product1_name = $row1['product_name'];
                                ?>
                    <option value="<?php echo $product1_id;?>"><?php echo $product1_name;?>
                    </option>

                    <?php
                                }
                                ?>
                </select>
                 <!--Simon-->
                <!-- Da popup.php er i en sepperat side fra feedet, skal vi gemme "Product_id" Derfor bruger vi et Hidden input, så vi kan bruge den på "Feed.php". -->
                <input type="hidden" name="product_id_2" value="<?php echo $product_id ?>" />

            </div>

            <button type="submit" name="submit" class="btn btn-default btn-block">Anmod om byttehandel</button>
        </div>
    </div>

    <?php  
      }  
 }
 ?>
</form>
