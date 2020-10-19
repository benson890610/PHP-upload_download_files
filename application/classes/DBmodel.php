<?php

    require "Database.php";

    class DBmodel {

        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function persist(string $name, string $type, int $size) {
            $sql = "INSERT INTO files
                    SET
                        name = ?,
                        type = ?,
                        size = ?";
            $this->db->prepare($sql);
            $this->db->execute([$name, $type, $size]);
        }

        public function findSingle($id) {
            $sql = "SELECT * FROM files WHERE id = ?";
            $this->db->prepare($sql);
            $this->db->execute([$id]);

            return $this->db->single();
        }

        public function all() {
            $sql = "SELECT id, name FROM files";
            return $this->db->queryAll($sql);
        }

    }