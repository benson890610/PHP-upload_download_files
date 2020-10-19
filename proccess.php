<?php
    session_start();
    require 'application/interfaces/ClassInterfaces.php';
    require 'application/helpers.php';
    spl_autoload_register(function($className){
        if(file_exists('application/classes/' . $className . '.php')){
            require 'application/classes/' . $className . '.php';
        }
    });
    
    // Upload commited
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $files = new Files;
        $files->createUploadFiles();
    // Download commited
    } else {

        if(isset($_GET['file']) && !empty($_GET['file'] && is_numeric($_GET['file']))) {
            $file = new File;
            $file->download();
        } else {
            redirect('index');
        }
    }