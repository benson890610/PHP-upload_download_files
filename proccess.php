<?php
    ini_set('display_errors', 'on');
    session_start();
    require 'application/interfaces/ClassInterfaces.php';
    require 'application/classes/Validation.php';
    require 'application/classes/Files.php';
    require 'helpers.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $files = new Files;
        $files->createUploadFiles();
    } else {

        // Download files

    }