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
                $kid_id = $row1['kid_id'];
                $user_id = $row1['kid_id'];
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
             header("Location: parent_dine_born.php");
         }
            }
            ?>
            <div class="container pt-3 ml-0 px-0">
                <h5>Opdater oplysninger</h5>
            </div>
            <div class="container-fluid pt-3 px-0">
                <div class="row">

                    <fieldset class="col-md-8 col-lg-5 col-12">


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
                            <!-- HUB funktionen herunder ------------------------------------------------------>

                            <div class="container py-3 ml-0 px-0">
                                <h5>Dit barns hubs</h5>
                            </div>
                            <form method="post" id="hub_id_form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Vælg de hubs som du ønsker at tilknytte til dit barn</label><br>
                                    <select name="hub1[]" id="hub_post" data-title="Hubs" class="selectpicker py-3" multiple data-live-search="true" data-selected-text-format="count" data-none-results-text='Kan ikke finde et resultat. <br> Start en ny hub nedenfor:'>
                                        <?php 
                                        $query = "SELECT * FROM hubs ORDER BY postal_code";    
                                        $result = mysqli_query($con, $query);
                                        $rows = mysqli_num_rows($result);
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $hub_id = $row['hub_id'];
                                                    $postal_code = $row['postal_code'];
                                                    $hub_name = $row['hub_name'];


                                                               ?>

                                        <option <?php 
                                                    $query5 = "SELECT * FROM kid_hub
                                                            WHERE kid_id = '$user_id' AND hub_id = '$hub_id'";
                                                    $result5 = mysqli_query($con, $query5);
                                                    if (!$result5) die(mysqli_error($con));
                                                    else {
                                                        $row5 = mysqli_fetch_assoc($result5);

                                                        if($row5 > 0) {echo 'selected="selected"';}

                                                    }

                                            ?> value="<?php echo $hub_id;?>"><?php echo $postal_code . ' - '?> <?php echo $hub_name;?></option>

                                        <?php
                             }
                                                ?>
                                    </select>
                                    <!--  <input type="hidden" name="hub_id[]" value="<?php echo $hub_id ?>" />-->




                                    <br>
                                    <button class="btn btn-primary m-1" name="submit" type="submit">Opdater</button>
                                    <!--<div class="form-group">
                         <input type="submit" class="btn btn-info view_data" name="submit" value="Submit" />
                        </div>-->
                                </div>
                            </form>

                            <label class="pt-5">Kan du ikke finde din hub? Opret en ny her:</label>
                            <br>





                            <?php
                            if (isset($_POST['hub_name']) && isset($_POST['postal_code']))  {
                            $hub_name = $_POST['hub_name'];
                            $postal_code = $_POST['postal_code'];
                            $query = "SELECT * FROM hubs WHERE postal_code = '$postal_code' AND hub_name = '$hub_name'";
                            $result = mysqli_query($con, $query);
                            if (!$result) die (mysqli_error($con));
                            else {
                            $rows = mysqli_num_rows($result);
                            if ($rows > 0) {
                            ?>

                            <div class="form">
                                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                    <h1 class="h3 mb-3 font-weight-normal">Registrer Hub</h1>
                                    <label for="inputPostalcode" class="sr-only">Postnummer</label>
                                    <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
                                    <br>
                                    <label for="inputHub" class="sr-only">Hub navn</label>
                                    <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
                                    <br><br>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Register Hub</button>
                                </form>
                                <?php
                                    echo "<p class='registered error'>Dette hub eksisterer allerede</p>";
                                }

                                else if ($rows == 0) {
                                    $query = "INSERT INTO hubs(hub_name, postal_code) VALUES('$hub_name', '$postal_code')";
                                    $result = mysqli_query($con, $query);
                                    if(!$result) die(mysqli_error($con));
                                    else {

                                $query3 = "SELECT * from hubs WHERE hub_name = '$hub_name' AND postal_code = '$postal_code'";    
                                $result3 = mysqli_query($con, $query3);
                                if (!$result3){ die(mysqli_error($con));}
                                else { 
                                $row3 = mysqli_fetch_assoc($result3); 
                                $hub_id = $row3['hub_id'];
                                $query2 = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$hub_id', '$user_id')";
                                $result2 = mysqli_query($con, $query2);
                                     }



                                        ?>
                                <div class="form">
                                    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                        <h1 class="h3 mb-3 font-weight-normal">Registrer Hub</h1>
                                        <label for="inputPostalcode" class="sr-only">Postnummer</label>
                                        <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
                                        <br>
                                        <label for="inputHub" class="sr-only">Hub navn</label>
                                        <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
                                        <br><br>
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register Hub</button>
                                    </form>
                                    <?php
                                        echo "<p class='registered'>Hub registeret og du er det første medlem</p>";

                                    }
                                }
                            }
                        }
                            else {
                                ?>
                                    <div class="form pb-4">
                                        <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                            <div class="container py-3 ml-0 px-0">
                                                <h5>Registrer hub</h5>
                                            </div>
                                            <label for="inputPostalcode" class="sr-only">Postnummer</label>
                                            <input type="number" min="1000" max="9999" name="postal_code" id="inputPostalcode" class="form-control" placeholder="Postnummer" required>
                                            <br>
                                            <label for="inputHub" class="sr-only">Hub navn</label>
                                            <input type="text" name="hub_name" id="inputHub" class="form-control" placeholder="Hub navn" required>
                                            <br>
                                            <button class="btn btn-primary" type="submit">Register Hub</button>
                                        </form>

                                        <?php
                            }
                            ?>



                                    </div>


                                    <?php
                     if(isset($_POST["hub1"])){
                     $hubsid = $_POST['hub1'];
                        //echo $hubsid;
                        for($i = 0; $i < count($hubsid); $i++){
                            $query = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$hubsid[$i]', '$user_id')";
                             $result = mysqli_query($con, $query);

                            if(!$result) die(mysqli_error($con));
                            // else {
                               //  echo 'Du er nu registreret på de valgte hubs';
                            // }
                        }
                     }

                          /*                          



                                                    if(isset($_POST["hub_post"]))
                    {
                      foreach($_REQUEST['hub_post'] as $row)
                     {
                     $query = "INSERT INTO kid_hub(hub_id, kid_id) VALUES ('$row', '$user_id')"; 
                     }                               

                     if(mysqli_query($con, $query))
                     {
                      echo 'Data Inserted';
                     }
                    } */
                    ?>


                                    <!-- HUB funktionen herover ------------------------------------------------------>

                                    <div class="invalid-feedback"> Tryk "Opdater" for at opdatere informationer. </div>

                                </div>
                            </div>
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
