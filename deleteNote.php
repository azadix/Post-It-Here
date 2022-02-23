<?php
require "php/DatabaseOperations.php";

$result = $connection->deleteNote($_POST['body']);

//header("Location: index.php");