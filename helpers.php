<?php

    // Redirection
    function redirect(string $page) {
        header('Location: ' . $page . '.php');
        exit;
    }