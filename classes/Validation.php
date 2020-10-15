<?php

    class Validation {

        private $unallowedFiles = ['php', 'js'];

         public function notSubmited($files) {
            return empty($files['name'][0]);
         }

         public function storMessage(string $type, string $message) {

            if($type === 'error') {
                $class = 'alert alert-danger';
            } else {
                $class = 'alert alert-success';
            }
            
            $messages = implode('<br>', $messages);
            
            $_SESSION['msg'] = "<div class='". $class ."'>". $messages ."</div>";

         }

         public function unauthorize($file) {
            $fileExt = pathinfo($file->__get('name'), PATHINFO_EXTENSION);
            
            return in_array($fileExt, $this->unallowedFiles);
         }

         public static function showMessage() {

            if(isset($_SESSION['msg'])) {
                $message = $_SESSION['msg'];
                unset($_SESSION['msg']);
                
                return $message;
            }

            return '';
         }

    }