<?php

$page = 'Oprettelse af profil';
require_once('includes/header.php');

//Asbjørn

//print_r($_POST);
     if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['post_code'])){
         

         
    $first_name = get_post($con, 'first_name');
    $last_name = get_post($con, 'last_name');
    $email = get_post($con, 'email');
    $password = get_post($con, 'password');
    $postal_code = get_post($con, 'post_code');
         
   //Vi bruger vores Session til at hente det sidste ID der blev lavet.
    //Dette er nødvendigt fordi at de to registreringer er sepperate
    $kidID = $_SESSION['kidID'];
   
    $hash = password_hash($password, PASSWORD_DEFAULT);
          
         


     $query ="INSERT INTO parent(email, password, kid_id) VALUES('$email', '$hash', '$kidID')";
     $result = mysqli_query($con, $query);

     if(!$result) 
         die(mysqli_error($con));
         
     
         
         $parentID = $con->insert_id;

         
         $query ="INSERT INTO parent_info(first_name, last_name, postal_code, timestamp, parent_id) VALUES('$first_name', '$last_name', '$postal_code', NOW(), '$parentID')";
             $result = mysqli_query($con, $query);
         if(!$result) die(mysqli_error($con));
         else {
             echo "Registreringen er nu gennemført";
         }
     }






?>

<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <header class="pt-3 text-center">
        <h1>Bruger registrering</h1>
    </header>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3">

            </div>

            <fieldset class="col-md-6">

                <h2>Forældre registrering</h2>

                <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label for="validationCustom01">Fornavn</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="fornavn" name="first_name" required>
                            <div class="invalid-feedback"> Indtast venligst dit fornavn. </div>

                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="validationCustom02">Efternavn</label>
                            <input type="text" class="form-control" id="validationCustom02" placeholder="efternavn" name="last_name" required>
                            <div class="invalid-feedback"> Indtast venligst dit efternavn. </div>

                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="validationCustom04">Post nr.</label>
                            <input type="phone" class="form-control" id="validationCustom04" placeholder="0000" name="post_code" required>
                            <div class="invalid-feedback"> Indtast venligst dit post nr. </div>
                        </div>


                        <div class="col-md-6 mb-4">
                            <label for="validationCustomEmail">E-Mail</label>
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text" id="inputGroupPrepend">@</span> </div>
                                <input type="email" class="form-control" id="validationCustomUsername" placeholder="email" aria-describedby="inputGroupPrepend" name="email" required>
                                <div class="invalid-feedback"> Indtast venligst en valid e-mail addresse. </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="validationCustomPasword">Kodeord</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="validationCustomPassword" placeholder="********" aria-describedby="inputGroupPrepend" name="password" required>
                                <div class="invalid-feedback"> Indtast venligst et kodeord. </div>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck"> Accepter <a href="terms.php" target="_blank">terms and conditions</a></label>
                            <div class="invalid-feedback"> Du skal acceptere vilkår og regler før oprettelse. </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Registrer</button>
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

    <?php
function get_post($con, $var) {
	return mysqli_real_escape_string($con, $_POST[$var]);
}
?>
