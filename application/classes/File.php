<?php

    require "DBmodel.php";

    class File implements FileInterface {

        private $db;

        private $name;
        private $tmp_name;
        private $type;
        private $size;

        private $maxSize = 3000000;

        public function __construct() {

            $this->db = new DBmodel;

        }

        public function save() {
            $this->size = (int) $this->size;
            $this->db->save($this->name, $this->type, $this->size);
        }

        public function upload() {
            move_uploaded_file($this->tmp_name, "application/files/" . $this->name);
        }

        public function __set($property, $value) {
            if(property_exists($this, $property)) {
                $this->$property = $value;
            } else {
                $error = __CLASS__ . " " . $property . " property does not exists";
                die($error);
            }
        }

        public function __get($property) {
            if(property_exists($this, $property)) {
                return $this->$property;
            } else {
                $error = __CLASS__ . " " . $property . " property does not exists";
                die($error);
            }
        }

    }