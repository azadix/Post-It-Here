<?php
    class Note extends User
    {
        private $connection;
        
        public function __construct ($tempConnection)
        {
            $this->connection = $tempConnection;
        }
        
        public function addNote($userId)
        {
            
            $qr = "INSERT INTO 
                            `notes` (
                                `uploaderId`
                            )
                        VALUES (
                            '{$userId}'
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

        public function updateTitle($noteId, $title)
        {
            $qr = "UPDATE
                        `notes`
                    SET
                        `title` = '{$title}'
                    WHERE
                        `id` = {$noteId}
                    ";

            return $this->connection->query($qr);
        }

        public function getNotes()
        {
            $ret=[];
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
    