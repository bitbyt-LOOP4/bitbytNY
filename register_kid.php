<?php
$page = 'Oprettelse af profil';
require_once('includes/header.php');
?>
<?php
//Asbjørn
     if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['age'])) {
        $first_name = get_post($con, 'first_name');
        $last_name = get_post($con, 'last_name');
        $username = get_post($con, 'username');
        $password = get_post($con, 'password');
        $age = get_post($con, 'age');
    
    
        $hash = password_hash($password, PASSWORD_DEFAULT);
         
       /*  $q_kid2parent ="INSERT INTO parent(kid_id)
         VALUES('$kid_id')";
         $result = mysqli_query($con, $q_kid2parent);
         if(!$result) die(mysqli_error($con)); */
         

         $query1 ="INSERT INTO kid(username, password)
         VALUES('$username', '$hash')";
         
         $result = mysqli_query($con, $query1);
         
         if(!$result) 
             die(mysqli_error($con));
         
         // Kid created
         // Vi smidder den sidste lavede ID, ind i en session, så vi kan bruge den på den anden side
         $kidID = $con->insert_id;
         $_SESSION['kidID'] = $kidID;
         
         
    
         
         $query ="INSERT INTO kid_info(first_name, last_name, age, timestamp, kid_id) VALUES('$first_name', '$last_name', '$age', NOW(), '$kidID')";
         
         $result = mysqli_query($con, $query);
         if(!$result)
             die(mysqli_error($con));
         else {
             header("Location: register_parrent.php");
         }
     }
?>
<header class="text-center pt-3">
    <h1>Bruger registrering</h1>
</header>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-3">

        </div>
        <fieldset class="col-md-6">

            <h2>Børne oprettelse</h2>

            <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="validationCustom01">Fornavn</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="Kim" name="first_name" required>
                        <div class="invalid-feedback"> Indtast venligst dit fornavn. </div>


                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="validationCustom02">Efternavn</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Larsen" name="last_name" required>
                        <div class="invalid-feedback"> Indtast venligst dit efternavn. </div>

                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="validationCustom02">Alder</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="12" name="age" required>
                        <div class="invalid-feedback"> Indtast venligst din alder. </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="validationCustomPasword">Brugernavn</label>
                        <div class="input-group">
                            <input type="username" class="form-control" id="validationCustomPassword" placeholder="" aria-describedby="inputGroupPrepend" name="username" required>
                            <div class="invalid-feedback"> Indtast venligst et brugernavn. </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="validationCustomPasword">Kodeord</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="validationCustomPassword" placeholder="********" aria-describedby="inputGroupPrepend" name="password" required>
                            <div class="invalid-feedback"> Indtast venligst et kodeord. </div>

                        </div>
                    </div>
                </div>

               
                <button class="btn btn-primary" type="submit">Næste</button>

                <div class="invalid-feedback"> Tryk "næste" for forældre registrering. </div>


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
require_once('includes/footer.php')
?>
