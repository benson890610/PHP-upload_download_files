<?php

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
        } else {

            // Check if client has submited more than 5 files
            $totalFilesForUpload = count($this->files['name']);
            if($totalFilesForUpload > $this->maxUploadFiles) {
                $validate->storeMessage('error', 'Maximum ' . $this->maxUploadFiles . ' files are allowed for upload');
            }

            // Restrict to maximum 5 files for upload
            $totalFiles = $this->getTotalFiles();

            // Save file data to database, upload actual file to files directory
            for($i = 0; $i < $totalFiles; $i++) {

                $file = $this->createFile($i);
                if($validate->unauthorize($file)) {
                    $validate->storeMessage('error', $file->__get('name') . ' is not allowed for upload');
                } elseif($validate->bigsize($file)) {
                    $validate->storeMessage('error', $file->__get('name') . ' has exceeded ' . ($file->__get('maxSize') / 1000000) . 'Mb size');
                } else {
                    $file->save();
                    $file->upload();
                    $validate->storeMessage('success', $file->__get('name') . ' has been uploaded');
                }

            }
        }
    
        $messages = $validate->getMessages();
        session($messages);
        redirect('index');
    }

    private function createFile($i) {
        
        $file = new File;

        $filename = pathinfo($this->files['name'][$i], PATHINFO_FILENAME);
        $ext = pathinfo($this->files['name'][$i], PATHINFO_EXTENSION);

        $file->__set('name',     $filename . '_' . time() . '.' . $ext);
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