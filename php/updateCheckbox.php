<?php
    require "databaseConnection.php";
    require "Class/User.php";
    require "Class/Note.php";

    $note = new Note($connection);
    $note->updateNoteStatus($_POST['containerId'], $_POST['id'], $_POST['status']);
    unset($note);
    