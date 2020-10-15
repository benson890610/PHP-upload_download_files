<?php

require 'interfaces/FilesInterface.php';
require 'Validation.php';
require 'File.php';

class Files implements FilesInterface {

    private $files = [];
    private $maxUploadFiles = 5;

    public function __construct() {
        $this->files = $_FILES['files'];
    }

    public function createUploadFiles() {
        $validate = new Validation;
        // Client has not choosed an image
        if($validate->notSubmited($this->files)) {
            $validate->storeMessage('error', 'Please choose a file for upload');
            $this->redirect('index');
        } else {

            $totalFiles = $this->getTotalFiles();
            for($i = 0; $i < $totalFiles; $i++) {

                $file = $this->createFile($i);
                
                if($validate->unauthorize($file)) $validate->storeMessage("error", "<strong>" . $file->__get('name') . "</strong> is not allowed to upload");

                else if($validate->size($file)) {
                    $maxSize = $validate->__get('maxAllowedSize') / 1000000;
                    $validate->storeMessage("error", "<strong>" . $file->__get('name') . "</strong> has exceeded maximum allowed size of $maxSize Mb");
                }

                die();

            }
        }
    }

    private function createFile($i) {
        
        $file = new File;
        $file->__set('name',     $this->files['name'][$i]);
        $file->__set('tmp_name', $this->files['tmp_name'][$i]);
        $file->__set('type',     $this->files['type'][$i]);
        $file->__set('size',     $this->files['size'][$i]);

        return $file;

    }

    private function getTotalFiles() {

        $files = count($this->files['name']);
        $files = ($files > $this->maxUploadFiles) ? $this->maxUploadFiles : $files;

        return $files;
    }

}