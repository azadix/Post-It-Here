<?php
    define('ROOT_DIR', realpath(__DIR__.'/..'));
    require "Class/Database.php";
    
    global $connection;
    
    function connectToMYSQL()
    {
        $connection = new Database;
        $connection->createDatabaseIfDoesntExist();
        $connection->connect($connection->getDatabaseName());
        $connection->createNotesTableIfDoesntExist();
        $connection->createUsersTableIfDoesntExist();
        
        if (!$connection) {
            die("Error: connection to database wasn't established");
        }
        return $connection;
    }

    $connection = connectToMYSQL();
    