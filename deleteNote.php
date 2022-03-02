<?php
require "php/DatabaseOperations.php";

$result = $connection->deleteNote($_GET['note']);
header("Location: index.php");