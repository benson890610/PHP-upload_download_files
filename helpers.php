<?php

    // Redirection
    function redirect(string $page) {
        header('Location: ' . $page . '.php');
        exit;
    }

    function session(array $messages) {
        if(count($messages) > 0) {
            $pageMessages = implode('<br>', $messages);
            $_SESSION['messages'] = $pageMessages;
        }
    }

    function messages() {
        if(isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        }
        return '';
    }