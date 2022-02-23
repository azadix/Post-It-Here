<?php
    require "php/DatabaseOperations.php";

    if (isset($_COOKIE['isLoggedIn']) == true) {
        unset($_COOKIE['isLoggedIn']);
        setcookie('isLoggedIn', false);
        setcookie('username', 'Anonymous');
        header("Location: index.php");
    }
