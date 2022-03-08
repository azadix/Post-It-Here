<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $order = count($note->getNotes($_POST['containerId']));
    $note->addNote($_POST['containerId'], $order);
    unset($note);