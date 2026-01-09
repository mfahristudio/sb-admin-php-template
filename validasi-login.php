<?php
error_reporting(0);

function validateLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
        $cookies = ['user_id', 'username'];
        
        foreach ($cookies as $cookie) {
            if (isset($_COOKIE[$cookie])) {
                setcookie($cookie, '', time() - 3600, '/');
            }
        }
        
        session_destroy();
        header('Location: index.php');
        exit();
    }
    
    require_once "core.php";
}

validateLogin();
