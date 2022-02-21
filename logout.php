<?php
    require "php/DatabaseOperations.php";

    if (isset($_COOKIE['isLoggedIn']) == true) {
        unset($_COOKIE['isLoggedIn']);
        setcookie('isLoggedIn', false);
        header("Location: index.php");
    }
