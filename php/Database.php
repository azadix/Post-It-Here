<?php
    class Database
    {
        private $host;
        private $login;
        private $pass;
        private $databaseName;
        protected $connection;
        
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
        
        public function createNotesTableIfDoesntExist()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `notes` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `title` TEXT(60) NOT NULL,
                    `uploaderId` INT(6) UNSIGNED NOT NULL,
                    `createdAt` TIMESTAMP NOT NULL,
                    `content` VARCHAR(255) NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

            return $this->connection->query($qr);
        }

        public function createUsersTableIfDoesntExist()
        {
            $qr = "CREATE TABLE IF NOT EXISTS `users` (
                    `id` INT(8) NOT NULL AUTO_INCREMENT,
                    `username` TEXT(60) NOT NULL,
                    `hashedPassword` TEXT(255) NOT NULL,
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

        public function addNewUser($username, $password)
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $qr = "INSERT INTO 
                        `users` (
                            `username`,
                            `hashedPassword`
                        )
                    VALUES (
                        '{$username}',
                        '{$hashedPassword}'
                    );";
            
            return $this->connection->query($qr);
        }

        public function checkIfRegistered($username, $password)
        {
            $isPasswordMatching = false;
            $qr = "SELECT 
                        `hashedPassword`
                    FROM
                        `users`
                    WHERE
                        `username` = '{$username}';";
            
            $response = $this->connection->query($qr);

            if ($response->num_rows > 0) {
                $row = $response->fetch_assoc();
                $isPasswordMatching = password_verify($password, $row["hashedPassword"]);
            }
            return $isPasswordMatching;
        }

        public function checkIfUsernameAlreadyExists($username)
        {
            $isUsernameAlreadyPresent = false;
            $qr = "SELECT 
                        `username`
                    FROM
                        `users`
                    WHERE
                        `username` = '{$username}';";
            
            $response = $this->connection->query($qr);

            if ($response->num_rows > 0) {
                $row = $response->fetch_assoc();
                if ($username ==  $row["username"]) {
                    $isUsernameAlreadyPresent = true;
                }
            }
            return $isUsernameAlreadyPresent;
        }

        public function getUserID($username)
        {
            $qr = "SELECT 
                        `id`
                    FROM
                        `users`
                    WHERE
                        `username` = '{$username}';";
            
            $response = $this->connection->query($qr);

            if ($response->num_rows > 0) {
                $row = $response->fetch_assoc();
            }
            return $row["id"];
        }

        public function addNote($username)
        {
            $qr = "INSERT INTO 
                            `notes` (
                                `title`,
                                `uploaderId`
                            )
                        VALUES (
                            '{$username}',
                            '{$this->getUserID($username)}'
                        );";
            return $this->connection->query($qr);
        }

        public function deleteNote($noteId)
        {
            $qr = "DELETE FROM 
                            `notes`
                        WHERE
                            `id` = {$noteId};";
            return $this->connection->query($qr);
        }

        public function getNotes()
        {
            $ret="";
            $qr = "SELECT 
                        *
                    FROM
                        `notes`
                    ";

            $response = $this->connection->query($qr);

            if ($response->num_rows > 0) {
                $ret = $response->fetch_all(MYSQLI_ASSOC);
            }
            return $ret;
        }
    }
