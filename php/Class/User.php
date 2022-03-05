<?php
    class User 
    {
        private $connection;

        public function __construct ($tempConnection)
        {
            $this->connection = $tempConnection;
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

        public function getUserName($userId)
        {
            $qr = "SELECT 
                        `username`
                    FROM
                        `users`
                    WHERE
                        `id` = '{$userId}';";
            
            $response = $this->connection->query($qr);
            if ($response->num_rows > 0) {
                $row = $response->fetch_assoc();
            }
            return $row["username"];
        }
    }