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

    }