<?php

    class File {

        private $name;
        private $tmp_name;
        private $type;
        private $size;

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