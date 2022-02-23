<?php
require "php/DatabaseOperations.php";

$result = $connection->addNote($_COOKIE['username']);
//header("Location: index.php");