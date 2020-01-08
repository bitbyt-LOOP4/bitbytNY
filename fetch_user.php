<?php
//require_once('includes/header.php');
if(!isset($_SESSION)) session_start();
require_once('conn.php');
//require_once('connnect.php');
//require_once('includes/header.php');
if(!isset($_SESSION['user_id'])) {
	header("location:user-log-in.php");
}
else {
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr class="bg-info text-white">
            <td>Brugernavn</td>
            <td>Status</td>
            <td></td>
        </tr>
        <?php
	$user_id = $_SESSION['user_id'];
	//echo $user_id;
	//$query = "SELECT * FROM kid WHERE user_id != '$user_id'";
    
    // $query= "SELECT * FROM `kid` WHERE user_id != '$user_id' AND trans_id = '$user_id'");
     
          $query = "SELECT * FROM `kid` 
            JOIN `kid_info` ON  kid.user_id = kid_info.kid_id
            JOIN `transactions` ON kid.user_id = transactions.kid_id_2 OR kid.user_id = transactions.kid_id_1
        WHERE transactions.kid_id_1 = '$user_id' AND kid.user_id != '$user_id' OR transactions.kid_id_2 = '$user_id' AND kid.user_id != '$user_id'";
    
      /*   $query = "SELECT * FROM `kid`
                JOIN `kid_info` ON kid.user_id = kid_info.kid_id
                JOIN `product` ON kid.user_id = product.kid_id
                JOIN `transactions` ON product.product_id = transactions.product1_id OR product.product_id = transactions.product2_id
            WHERE kid.user_id != '$user_id'"; */
    
   
    
    
	$result = mysqli_query($con, $query);
	if (!$result) die(mysqli_error($con));
	else {
		$rows = mysqli_num_rows($result);
		if ($rows > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$user_id1 = $row['user_id'];
				$username = $row['username'];
				$status = '';
 				$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 				$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 				$user_last_activity = fetch_user_last_activity($user_id1, $con);
 				if ($user_last_activity > $current_timestamp) {
					$status = '<button class="alert alert-success m-0 p-2" disabled>Online</button>';
				}
				else {
					$status = '<button class="alert alert-danger m-0 p-2" disabled>Offline</button>';
				}
				echo "<tr><td>" . $username . " " . count_unseen_message($user_id1,  $user_id, $con) . " " . fetch_is_type_status($user_id1, $con) ."</td>";
  				echo "<td>" . $status . "</td>";
  				echo "<td><button type='button' class='btn btn-info btn-xs start_chat' data-touserid='" .$user_id1 . "' data-tousername='" .$username . "'>Start Chat</button></td>";
				echo "</tr>";
			}
		}
			?>
    </table>
</div>
<?php
		}
	}

?>
