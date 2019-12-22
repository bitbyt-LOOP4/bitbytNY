<?php                                                   // Jesper & Oliver
    $page='Dine børn';
    require_once('includes/header_parent.php');
    if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id']; 
    function get_post($con, $var) {
	return mysqli_real_escape_string($con, $_POST[$var]);
}
    ?>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">

    <?php 
           $barn1 = "SELECT * FROM `kid_info`
                            JOIN `parent` ON parent.kid_id = kid_info.kid_id OR parent.kid_id2 = kid_info.kid_id
                            JOIN `kid` ON kid.user_id = kid_info.kid_id
                    WHERE parent.parent_id = '$parent_id'";
    $result1 = mysqli_query($con, $barn1);
        
    if (!$result1) die(mysqli_error($con));
    else ($rows1 = mysqli_num_rows($result1));
        
        if ($rows1 > 0) {
            while ($row1 = mysqli_fetch_array($result1)) {
                $fornavn = $row1['first_name'];
                $efternavn1 = $row1['last_name'];
                $alder1 = $row1['age'];
                $username1 = $row1['username'];
                $kid_id = $row1['kid_id']
                ?>
    <div class="container-fluid px-0 pb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-0 mb-3 border-bottom">
            <h1><?php echo $fornavn . ' ' . $efternavn1 ?></h1>
        </div>
        <!-- Start registreringskode ---------------------------------------------->
        <div class="container-fluid px-0">
            <?php
            if (/*isset($_POST['username']) && */isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['age'])) {
            $first_name = get_post($con, 'first_name');
            $last_name = get_post($con, 'last_name');
           // $username = get_post($con, 'username');
           // $password = get_post($con, 'password');
            $age = get_post($con, 'age');


          //  $hash = password_hash($password, PASSWORD_DEFAULT);

           /* 
           $query1 = "UPDATE kid
                        SET username = '$username'
                        WHERE user_id = '$kid_id'";
            
            $result = mysqli_query($con, $query1);

            if(!$result)
            die(mysqli_error($con));
            */
            // Kid created

            $query ="UPDATE kid_info
                    SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    age = '$age'
                    WHERE kid_id = '$kid_id'";

            $result = mysqli_query($con, $query);
            if(!$result)
            die(mysqli_error($con));
            else {
             header("Location: parent_admin.php");
         }
            }
            ?>
            <div class="container pt-3 ml-0 px-0">
                <h5>Opdater oplysninger</h5>
            </div>
            <div class="container-fluid pt-3 px-0">
                <div class="row">

                    <fieldset class="col-md-8 col-lg-6 col-12">


                        <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                            <div class="form-row">
                                <div class="col-md-6 mb-4">
                                    <label for="validationCustom01">Fornavn</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="Kim" name="first_name" value="<?php echo $fornavn ?>" required>
                                    <div class="invalid-feedback"> Indtast venligst fornavn. </div>


                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="validationCustom02">Efternavn</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="Larsen" value="<?php echo $efternavn1 ?>" name="last_name" required>
                                    <div class="invalid-feedback"> Indtast venligst efternavn. </div>

                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="validationCustom02">Alder</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="12" name="age" value="<?php echo $alder1 ?>" required>
                                    <div class="invalid-feedback"> Indtast venligst alder. </div>
                                </div>
                                <!-- Opdater brugernavn
                                <div class="col-md-12 mb-4">
                                    <label for="validationCustomPasword">Brugernavn</label>
                                    <div class="input-group">
                                        <input type="username" class="form-control" id="validationCustomPassword" placeholder="" aria-describedby="inputGroupPrepend" name="username" value="<?php echo $username1 ?>" required>
                                        <div class="invalid-feedback"> Indtast venligst et brugernavn. </div>
                                    </div>
                                </div>
-->
                                <!--
                                <div class="col-md-12 mb-4">
                                    <label for="validationCustomPasword">Kodeord</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="validationCustomPassword" placeholder="********" aria-describedby="inputGroupPrepend" name="password" required>
                                        <div class="invalid-feedback"> Indtast venligst et kodeord. </div>

                                    </div>
                                </div>

-->
                            </div>
                            <button class="btn btn-primary" type="submit">Opdater</button>

                            <div class="invalid-feedback"> Tryk "Opdater" for at opdatere informationer. </div>


                        </form>

                        <br><br>

                    </fieldset>
                    <div class="d-none col-md-3"></div>
                </div>
            </div>

            <script>
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {

                        var forms = document.getElementsByClassName('needs-validation');

                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();

                select.onchange = function() {
                    input.value = select.value;
                }

            </script>
            <!-- Slut registrerings kode ---------------------------->
        </div>

    </div>


    <?php
            }
        }
        ?>
</main>

<?php require_once('includes/footer_parent.php') ?>

<?php 
    die();
    }
elseif (!isset($_SESSION['parent_id'])) {
	?>
<div class="container px-5 py-5">
    <div class=jumbotron>
        <h2>Du har ikke adgang til denne side. Venligst <a href="parent-login.php">log ind</a> først.</h2>
    </div>
</div>


<?php
function get_post($con, $var) {
	return mysqli_real_escape_string($con, $_POST[$var]);
}
    ?>
<?php
}
require_once('includes/footer_parent.php');
die();
?>
