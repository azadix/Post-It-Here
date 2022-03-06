<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $note->addNote($_POST['containerId'], $_POST['order']);
    unset($note);