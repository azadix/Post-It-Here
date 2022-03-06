<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $note->deleteContainer($_POST['id']);
    unset($note);
