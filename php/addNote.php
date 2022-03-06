<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    session_start();
    (isset($_SESSION['user'])) ? $userId=$_SESSION['user'] : $userId=0;
    
    $note = new Note($connection);
    $note->addNote($userId);
    unset($note);
