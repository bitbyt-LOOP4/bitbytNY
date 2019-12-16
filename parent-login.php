<?php
$page = 'Log ind';                                          // Jesper
require_once('includes/header.php');
if(isset($_SESSION['user_id'])) {
    header('Location: feed.php');
}
if(isset($_SESSION['parent_id'])) {
    header('Location: parent_admin.php');
} 
if (isset($_COOKIE['login-parent'])) {
	$parent_email = $_COOKIE['login-parent'];
} else {
	$parent_email = '';
}
if(isset($_POST['email']) && isset($_POST['password'])) {
    $parent_email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM parent WHERE email = '$parent_email'";
    $result = mysqli_query($con, $query);
    if (!$result){
        echo "MySQL Error: " . mysqli_error($con);
        require_once ('includes/footer.php');
        die();  
    } 
    else {
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
            echo '<script>alert("Denne bruger eksiterer ikke")</script>';
        }
        while($row = mysqli_fetch_assoc($result)){
            $parent_email = $row['email'];
            $database_password = $row['password'];
            $parent_id = $row['parent_id'];
            $token = password_verify($password, $database_password);
            if ($token != $password) {
                    echo '<script>alert("Forkert brugernavn eller kodeord")</script>';
            }
            if ($token == $password) {
                $_SESSION['parent_id'] = $parent_id;
                if (isset($_POST['remember'])) {
                    $cookie_name = 'login-parent';
                    $cookie_value = $parent_email;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                    header('Location: parent_admin.php');
                }
                else {
                    header('Location: parent_admin.php');
                }
            }
        }
    }
}
?>


<div class="container col-12 col-sm-6 col-md-5 col-lg-4 col-xl-4 pb-5">
    <form class="form-signin container" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <h1 class="h3 my-3 pt-5 font-weight-normal">Forældre log-in</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control mb-2" placeholder="Email" value="<?php echo $parent_email; ?>" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control  mb-2" placeholder="Kodeord" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember" name="remember"> Husk mig </label>
        </div>
        <button class="btn-login btn-submit btn btn-md btn-primary" type="submit">Log ind</button>
    </form>
</div>

<?php
require_once('includes/footer.php');
?>
