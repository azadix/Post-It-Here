<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $note->updateTitle($_POST['id'], $_POST['title']);