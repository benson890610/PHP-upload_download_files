<?php

    class Validation {

         public function notSubmited($files) {
            return empty($files['name'][0]);
         }

         public function message(string $type, array $messages) {

            if($type === 'error') {
                $class = 'alert alert-danger';
            } else {
                $class = 'alert alert-success';
            }
            
            $messages = implode('<br>', $messages);
            
            $_SESSION['msg'] = "<div class='". $class ."'>". $messages ."</div>";

            $this->redirect('index');

         }

         public static function showMessage() {

            if(isset($_SESSION['msg'])) {
                $message = $_SESSION['msg'];
                unset($_SESSION['msg']);
                
                return $message;
            }

            return '';
         }

         private function redirect($page) {
            header('Location: ' . $page . '.php');
            exit;
         }

    }