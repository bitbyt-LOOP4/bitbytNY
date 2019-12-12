<?php
$page = 'Log ind';                                          // Jesper
require_once('includes/header.php');
if(isset($_SESSION['user_id'])) {
    header('Location: feed.php');
}
if (isset($_COOKIE['login'])) {
	$kid_username = $_COOKIE['login'];
} else {
	$kid_username = '';
}
if(isset($_POST['username']) && isset($_POST['password'])) {
    $kid_username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM kid WHERE username = '$kid_username'";
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
            $kid_username = $row['username'];
            $database_password = $row['password'];
            $user_id = $row['user_id'];
            $token = password_verify($password, $database_password);
            if ($token != $password) {
                    echo '<script>alert("Forkert brugernavn eller kodeord")</script>';
            }
            if ($token == $password) {
                $_SESSION['user_id'] = $user_id;
                if (isset($_POST['remember'])) {
                    $cookie_name = 'login';
                    $cookie_value = $kid_username;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day
                    header('Location: feed.php');
                }
                else {
                    header('Location: feed.php');
                }
            }
        }
    }
}
?>


<div class="container col-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
    <form class="form-signin container" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <h1 class="h3 my-3 pt-5 font-weight-normal">Log ind</h1>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="username" name="username" id="inputUsername" class="form-control mb-2" placeholder="Brugernavn" value="<?php echo $kid_username; ?>" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control  mb-2" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember" name="remember"> Husk mig </label>
        </div>
        <button class="btn-submit btn btn-md btn-primary btn-login" type="submit">Log ind</button>
    </form>
</div>

<?php
require_once('includes/footer.php');
?>
