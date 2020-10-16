<?php

    require "Database.php";

    class DBmodel {

        private $db;

        public function __construct() {

            $this->db = new Database;

        }

        public function save(string $name, string $type, int $size) {

            $sql = "INSERT INTO files
                    SET
                        name = ?,
                        type = ?,
                        size = ?";
            $this->db->prepare($sql);
            $this->db->execute([$name, $type, $size]);

        } 

    }