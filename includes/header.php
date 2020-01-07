<?php
session_start();
require_once('conn.php');
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];  
    $query = "SELECT bytcoin 
              FROM kid_info 
              WHERE kid_id = '$user_id'";
        $result = mysqli_query($con, $query);
        if (!$result){ die(mysqli_error($con));}
            
        else  { 
            $row = mysqli_fetch_assoc($result);

            $bytcoin = $row['bytcoin'];
             }
    
    /* Jesper/ Variabel til at styre navbaren */
    $menu = '
           <!--Jesper/ Det her er til top navigationen på computeren når man er logget ind-------------->
    <nav class="navbar sticky-top navbar-light bg-bitbyt navbar-default d-none d-md-block">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.php">
                    <img src="images/logo_transparent1.png" alt="logo" class="logo">
                </a>
            </div>
            
  
            <ul class="nav navbar-right">
                <li>
                    <a href="parent-login.php" class="nav-link my-3 pr-2 icon-navbar icon_text bytcoin"> ' . $bytcoin . ' 
                          <img style="width: 20px" src="images/bitcoin (1).svg">
                    </a>
                  
                </li>
                <li>
                    <a href="./feed.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-home bottom_icons icon-color"></i><br>
                        Hjem </a>
                </li>
                <li>
                    <a href="./register_items.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-plus-circle bottom_icons icon-color"></i><br>
                        Upload</a>
                </li>
                <li>
                    <a href="./soeg.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-search bottom_icons icon-color"></i><br>
                        Søg</a>
                </li>
                <! <li>
                    <a href="./chat.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-comment-dots bottom_icons icon-color"></i><br>
                        Beskeder</a>
                    </li>
                    <li>
                        <a href="./profil.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-user bottom_icons icon-color"></i><br>
                            Profil</a>
                    </li>
                    <li>
                        <a href="./logout.php" class="nav-link my-2 icon-navbar icon_text"><i class="fas fa-sign-out-alt bottom_icons icon-color"></i><br>
                            Log ud</a>
                    </li>
                    
            </ul>
        </div>
    </nav>
    <!-- Det her er til navigation på tablet og mobil -------------------------------------------------->
    <nav class="container-fluid fixed-bottom d-md-none container_head">
        <div class="row">
            <div class="col-2 bottom_links text-center pt-4">
                <a class="icon_text" href="feed.php">
                    <i class="fas fa-home bottom_icons"></i><br>
                    Hjem
                </a>

            </div>

            <div class="col-2 bottom_links text-center pt-4">
                <a class="icon_text" href="">
                    <i class="fas fa-search bottom_icons"></i><br>
                    Søg
                </a>
            </div>
            <div class="col-4 bottom_links pt-3" id="upload">
                <a class="icon_text" href="register_items.php">
                    <i class="fas fa-plus-circle bottom_icons fa-4x"></i><br>
                    Upload
                </a>
            </div>
            <div class="col-2 bottom_links text-center pt-4">
                <a class="icon_text" href="">
                    <i class="fas fa-comment-dots bottom_icons"></i><br>
                    Beskeder
                </a>
            </div>

            <div class="col-2 bottom_links text-center pt-4">
                <a class="icon_text" href="profil.php">
                    <i class="fas fa-user bottom_icons"></i><br>
                    Profil
                </a>
            </div>
        </div>
    </nav>  
';

    
} else /* Hvis brugeren ikke er logget ind vises denne */ { 
    $menu = '
        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-bitbyt navbar-default">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block">
                <!-- Centrerer logo på mobil --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="./index.php">
                <img src="images/logo_transparent1.png" alt="logo" class="logo">
            </a>
            <!-- Placerer logo i midten på små skærme -->
            <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="./index.php">
                <img src="images/logo_transparent1.png" alt="logo" class="logo">
            </a>
            <div class="w-100 text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
            <ul class="navbar-nav ml-auto flex-nowrap">
                <li class="nav-item">
                    <a href="faq.php" class="nav-link m-2 menu-item nav-active">Sådan virker det</a>
                </li>
                <li class="nav-item">
                    <a href="./user-log-in.php" class="nav-link m-2 menu-item">Log ind</a>
                </li>
                <li class="nav-item">
                    <a href="register_kid.php" class="nav-link m-2 menu-item btn btn-info btn-registrer">Opret nu!</a>
                </li>
            </ul>
        </div>
    </nav>
';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="bitbyt.dk">
    <meta name="viewport" content="width=device-width">
    <title>
        <?php echo $page;?>
    </title>
    <!-- Link til jquery og js ------------------------------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <!-- Bootstrap CSS -------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- Vores CSS ------------------------------------------------------>
    <link rel="stylesheet" href="styles/style.css">

    <!-- Kilde til fontawesome ikoner ----------------------------------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Google fonts ----->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Mono&display=swap" rel="stylesheet">
</head>

<!-- Script som er med til at få nav-bar til at skifte farve ved scroll --->
<script type="text/javascript">
    window.onload = function() {
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
    }

</script>

<body>
    <?php echo $menu; ?>
