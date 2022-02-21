<?php
    class Database
    {
        private $host;
        private $login;
        private $pass;
        private $databaseName;
        protected $connection;
        
        public function __construct($tempHost = "localhost", $tempLogin="admin", $tempPass = "admin")
        {
            $this->host = $tempHost;
            $this->login = $tempLogin;
            $this->pass = $tempPass;
            $this->connect();
        }
        
        public function connect($tempDatabasebName = false)
        {
            if ($tempDatabasebName) {
                $this->connection = new mysqli($this->host, $this->login, $this->pass, $tempDatabasebName);
            } else {
                $this->connection = new mysqli($this->host, $this->login, $this->pass);
            }
            
            return $this->connection;
        }
        
        public function createDatabaseIfDoesntExist()
        {
            $this->databaseName = "post-it-here";
            $qr = "CREATE DATABASE IF NOT EXISTS `{$this->databaseName}`;";
            return $this->connection->query($qr);
        }
        
        public function createTableIfDoesntExist()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `notes` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `title` TEXT(60) NOT NULL,
                    `uploaderId` INT(6) UNSIGNED NOT NULL,
                    `createdAt` TIMESTAMP NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

            return $this->connection->query($qr);
        }

        public function getDatabaseName()
        {
            return $this->databaseName;
        }

        public function setDatabaseName($tempDatabaseName)
        {
            $this->databaseName = $tempDatabaseName;
        }

        public function addNote()
        {
            $title = "elo";
            $userID = 1;

            $qr = "INSERT INTO 
                        `notes` (
                            `title`,
                            `uploaderId`
                        )
                    VALUES (
                        '{$title}',
                        '{$userID}'
                    );";
            return $this->connection->query($qr);
        }
    }
