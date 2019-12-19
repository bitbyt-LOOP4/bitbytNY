<?php
$page = 'bitbyt';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
}


?>

<!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Vælg hub
</button>

<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hubs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            
                            
                            
                


                <td>Hubs</td>
                <select name="" class="form-control">
                    <option selected value="">Vælg et eller flere hubs</option>

    <?php 
                    $query = "SELECT * from hubs ORDER BY postal_code";    
                    $result = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($result);
                            while($row1 = mysqli_fetch_assoc($result)) {
                                $hub_id = $row1['hub_id'];
                                $postal_code = $row1['postal_code'];
                                $hub_name = $row1['hub_name'];
                   
?>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1"> <option value="<?php echo $hub_id;?>"><?php echo $postal_code;?> <?php echo $hub_name;?>
                </option></label>
            </div>





            </select>
<?php
                            }

            ?>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>



</div>



<?php 
                    $query = "SELECT * from hubs ORDER BY postal_code";    
                    $result = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($result);
                            while($row1 = mysqli_fetch_assoc($result)) {
                                $hub_id = $row1['hub_id'];
                                $postal_code = $row1['postal_code'];
                                $hub_name = $row1['hub_name'];
                            ?>
<option value="<?php echo $hub_id;?>"><?php echo $postal_code;?> <?php echo $hub_name;?>
</option>
<?php
                            }
                            ?>
