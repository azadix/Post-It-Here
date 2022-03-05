<?php
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    $isLoggedIn = false;
    
    session_start();

    if (isset($_SESSION["user"])) {
        $isLoggedIn = true;

        $location='php/logout.php';
        $loginButtonPrompt='Log out';
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post-It-Here</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="index.php">
                <span class="bi bi-sticky"></span> Post-It-Here
            </a>

            <div class="justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link <?= ($activePage == 'index') ? 'active':''; ?>" href="index.php">Notes</a>
                    <?php
                        ($activePage == 'login') ? $activeClass='active': $activeClass='';
                        if ($isLoggedIn == false) {
                            $location='login.php';
                            $loginButtonPrompt='Log in';
                        }
                        echo "<a class='nav-link {$activeClass}' href='{$location}'>{$loginButtonPrompt}</a>"
                    ?>
                </div>
            </div>
        </div>
    </nav>