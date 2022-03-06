<?php
    class Database
    {
        private $host;
        private $login;
        private $pass;
        private $databaseName;
        protected $conn;
        
        public function __construct ($tempHost = "localhost", $tempLogin="admin", $tempPass = "admin")
        {
            $this->host = $tempHost;
            $this->login = $tempLogin;
            $this->pass = $tempPass;
            $this->connect();
        }
        
        public function connect($tempDatabasebName = false)
        {
            if ($tempDatabasebName) {
                $this->conn = new mysqli($this->host, $this->login, $this->pass, $tempDatabasebName);
            } else {
                $this->conn = new mysqli($this->host, $this->login, $this->pass);
            }
            
            return $this->conn;
        }

        public function query($qr)
        {
            return mysqli_query($this->conn, $qr);
        }
        
        public function createDatabase()
        {
            $this->databaseName = "post-it-here";
            $qr = "CREATE DATABASE IF NOT EXISTS `{$this->databaseName}`;";
            return $this->conn->query($qr);
        }
        
        public function createContainersTable()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `containers` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `title` TEXT(60) NOT NULL,
                    `uploaderId` INT(6) UNSIGNED NOT NULL,
                    `createdAt` TIMESTAMP NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

            return $this->conn->query($qr);
        }

        public function createNotesTable()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `notes` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `isChecked` INT(1) NOT NULL,
                    `content` TEXT(60) NOT NULL,
                    `order` INT(8) NOT NULL,
                    `containerId` INT(8) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

            return $this->conn->query($qr);
        }

        public function createUsersTable()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `users` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `username` TEXT(60) NOT NULL,
                    `hashedPassword` TEXT(255) NOT NULL,
                    `createdAt` TIMESTAMP NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

            return $this->conn->query($qr);
        }

        public function getDatabaseName()
        {
            return $this->databaseName;
        }

        public function setDatabaseName($tempDatabaseName)
        {
            $this->databaseName = $tempDatabaseName;
        }
    }
