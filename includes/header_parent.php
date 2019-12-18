<?php
session_start();
require_once('conn.php');
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Vores CSS ------------------------------------------------------>
    <link rel="stylesheet" href="styles/style-parent.css">
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

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand navbar-brand1 col-sm-3 col-md-2 mr-0 d-none d-md-block" href="./parent_admin.php">Bitbyt.dk</a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3 d-none d-md-block">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="./logout.php">Log ud</a>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark d-md-none">
        <a class="navbar-brand" href="#">Bitbyt.dk</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="./parent_admin.php">
                        <span data-feather="home"></span>
                        Overblik <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="dollar-sign"></span>
                        Bytcoins
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./parent_dine_born.php">
                        <span data-feather="users"></span>
                        Dine børn
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="message-circle"></span>
                        Beskeder
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="settings"></span>
                        Indstillinger
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="info"></span>
                        Spørgsmål
                    </a>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="./logout.php"><span class="fas fa-sign-out-alt bottom_icons icon-color mr-1"></span>Log ud</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <span data-feather="home"></span>
                                Overblik <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="dollar-sign"></span>
                                Bytcoins
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="users"></span>
                                Dine børn
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="message-circle"></span>
                                Beskeder
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="settings"></span>
                                Indstillinger
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="info"></span>
                                Spørgsmål
                            </a>
                        </li>
                    </ul>
                    <!--
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Year-end sale
                            </a>
                        </li>
                    </ul> -->
                </div>
            </nav>
