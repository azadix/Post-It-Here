<?php
    define('ROOT_DIR', realpath(__DIR__.'/..'));
    require "Database.php";
    
    global $connection;

    function connectToMYSQL()
    {
        // Connect to db using mysqli
        $connection = new Database;
        $connection->createDatabaseIfDoesntExist();
        $connection->connect($connection->getDatabaseName());
        $connection->createNotesTableIfDoesntExist();
        $connection->createUsersTableIfDoesntExist();
        
        //Check if connection was made
        if (!$connection) {
            die("Error: connection to database wasn't established");
        }
        return $connection;
    }

    $connection = connectToMYSQL();
    