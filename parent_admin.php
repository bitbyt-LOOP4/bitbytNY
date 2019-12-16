<?php                                                   // Jesper & Oliver
    $page='Forældre adminstration';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];}

   /* $barn1 = "SELECT * FROM `kid_info`
    JOIN `parent` ON parent.kid_id = kid_info.kid_id
    JOIN `kid` ON kid.user_id = kid_info.kid_id
    WHERE parent.parent_id = '$user_id'";

    $result = mysqli_query($con, $barn);
    if (!$result) die(mysqli_error($con));
    if ($rows > 0) {
    while $rows = mysqli_fetch_assoc($result) {
    $fornavn = $row['first_name'];
    $efternavn = $row['last_name'];
    $alder = $row['age'];
    $username = $row['username'];
    }
    } */
    ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php //echo $fornavn1 . " " . $efternavn1 ?>Barn 1</h1>
    </div>

    <div class="container-fluid px-0">
        <p>Her kan du se hvad dit barn har til salg</p>
    </div>
</main>

<?php 
require_once('includes/footer_parent.php')
    ?>
