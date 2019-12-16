<?php                                                   // Jesper & Oliver
    $page='Forældre adminstration';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];} 
    ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <?php 
           $barn1 = "SELECT * FROM `kid_info`
    JOIN `parent` ON parent.kid_id = kid_info.kid_id OR parent.kid_id2 = kid_info.kid_id
    JOIN `kid` ON kid.user_id = kid_info.kid_id
    WHERE parent.parent_id = 31";
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1><?php echo $fornavn . ' ' . $efternavn1 ?></h1>
        </div>

        <div class="container-fluid px-0">
            <p>Her kan du se hvad dit barn har til salg</p>
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
