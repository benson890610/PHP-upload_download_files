<?php

    class Validation {

        private $unallowedFiles = ['php', 'js'];
        private $error = [];
        private $success = [];

        public function notSubmited($files) {
            return empty($files['name'][0]);
        }

        public function storeMessage(string $type, string $message) {
            if($type === 'error') {
                array_push($this->error, $message);
            } else {
                array_push($this->success, $message);
            }
        }

        public function getMessages() {
            $error   = array_map(function($item){ return '<div class="alert alert-danger">'.$item.'</div>'; }, $this->error);
            $success = array_map(function($item){ return '<div class="alert alert-success">'.$item.'</div>'; }, $this->success);
            $messages = array_merge($error, $success);
            return $messages;
        }

        public function unauthorize($file) {
            $fileExt = pathinfo($file->__get('name'), PATHINFO_EXTENSION); 
            return in_array($fileExt, $this->unallowedFiles);
        }

        public function bigsize($file) {
            return $file->__get('size') > $file->__get('maxSize');
        }

        public static function showMessage() {

            if(isset($_SESSION['msg'])) {
                $message = $_SESSION['msg'];
                unset($_SESSION['msg']);
                
                return $message;
            }

            return '';
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