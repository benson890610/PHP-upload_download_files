<?php
    ini_set('display_errors', 'on');
    session_start();

    require 'classes/Files.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $files = new Files;
        $files->createUploadFiles();
    } else {

        // Download files

    }