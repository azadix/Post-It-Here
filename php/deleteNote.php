<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $result = $note->deleteNote($_GET['note']);
    //header("Location: ../index.php");
