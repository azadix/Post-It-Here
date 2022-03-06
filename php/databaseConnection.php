<?php
    //define('ROOT_DIR', realpath(__DIR__.'/..'));
    require "Class/Database.php";
    
    global $connection;
    
    function initializeDatabase()
    {
        $connection = new Database;
        $connection->createDatabase();
        $connection->connect($connection->getDatabaseName());
        $connection->createContainersTable();
        $connection->createNotesTable();
        $connection->createUsersTable();
        
        if (!$connection) {
            die("Error: connection to database wasn't established");
        }
        return $connection;
    }

    $connection = initializeDatabase();
    