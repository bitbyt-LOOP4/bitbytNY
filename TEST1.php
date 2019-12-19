<?php                                                   // Jesper & Oliver
$page='Min profil';
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
 ?>

<div class="container p-5">
    <script>
        // Material Select Initialization
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });

    </script>


    <select class="selectpicker" multiple data-live-search="true">
        <option value="" disabled selected>Choose your country</option>
        <option value="1">USA</option>
        <option value="2">Germany</option>
        <option value="3">France</option>
        <option value="3">Poland</option>
        <option value="3">Japan</option>
    </select>
    <label class="mdb-main-label">Label example</label>
    <button class="btn-save btn btn-primary btn-sm">Save</button>
</div>




<?php
require_once('includes/footer.php');
    ?>



<?php
die();
}
/* Hvis ikke brugeren er logget ind vil siden ikke være tilgængelig */
elseif (!isset($_SESSION['user_id'])) {
	?>
<div class="container pt-5">
    <div class=jumbotron>
        <h1>Du har ikke adgang til denne side. Venligst log ind først.</h1>
    </div>
</div>







<?php
}
require_once('includes/footer.php');
?>

<?php
die();
?>
