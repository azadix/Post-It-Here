<?php
    class Note extends User
    {
        private $connection;
        
        public function __construct ($tempConnection)
        {
            $this->connection = $tempConnection;
        }
        
        public function addContainer($userId)
        {
            $qr = "INSERT INTO 
                            `containers` (
                                `uploaderId`
                            )
                        VALUES (
                            '{$userId}'
                        );";
            return $this->connection->query($qr);
        }

        public function deleteContainer($containerId)
        {
            $qr = "DELETE FROM 
                            `containers`
                        WHERE
                            `id` = {$containerId};";
            
            return $this->connection->query($qr);
        }

        public function deleteAllNotesFromContainer($containerId) {
            $qr = "DELETE FROM 
                            `notes`
                        WHERE
                            `containerId` = {$containerId};";
            
            return $this->connection->query($qr);
        }

        public function updateContainerTitle($containerId, $title)
        {
            $qr = "UPDATE
                        `containers`
                    SET
                        `title` = '{$title}'
                    WHERE
                        `id` = {$containerId}";

            return $this->connection->query($qr);
        }

        public function getContainers()
        {
            $ret=[];
            $qr = "SELECT 
                        *
                    FROM
                        `containers`;";

            $response = $this->connection->query($qr);
            
            if ($response->num_rows > 0) {
                $ret = $response->fetch_all(MYSQLI_ASSOC);
            }
            return $ret;
        }

        public function addNote($containerId, $order)
        {
            $qr = "INSERT INTO 
                            `notes` (
                                `containerId`,
                                `order`
                            )
                        VALUES (
                            '{$containerId}',
                            '{$order}'
                        );";
            return $this->connection->query($qr);
        }

        public function getNotes($containerId)
        {
            $ret =[];
            $qr = "SELECT
                        *
                    FROM
                        `notes`
                    WHERE
                        `containerID` = {$containerId};";

            $response = $this->connection->query($qr);
            
            if ($response->num_rows > 0) {
                $ret = $response->fetch_all(MYSQLI_ASSOC);
            }
            return $ret;
        }
        
        public function updateNoteContent($containerId, $noteId, $content)
        {
            $qr = "UPDATE
                        `notes`
                    SET
                        `content` = '{$content}'
                    WHERE
                        `order` = {$noteId}
                    AND
                        `containerId` = {$containerId}";

            return $this->connection->query($qr);
        }

        public function updateNoteStatus($containerId, $noteId, $isChecked)
        {
            $qr = "UPDATE
                        `notes`
                    SET
                        `isChecked` = '{$isChecked}'
                    WHERE
                        `order` = {$noteId}
                    AND
                        `containerId` = {$containerId}";

            return $this->connection->query($qr);
        }
    }
    