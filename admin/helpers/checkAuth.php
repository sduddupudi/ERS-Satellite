<?php
    function checkAuth() {
        if(!isset($_SESSION["userID"])){
            $_SERVER['PHP_SELF'] != '/index.php' && $_SERVER['PHP_SELF'] != '/admin/login.php' && header('Location: '.$GLOBALS['siteURL']);
        }
    }

    function checkRedirect() {
        if(isset($_SESSION["userID"]) && isset($_SESSION["userType"])){
            switch ($_SESSION["userType"]) {
                case 'customer':
                    (!strripos($_SERVER['PHP_SELF'], 'admin/') || strripos($_SERVER['PHP_SELF'], 'admin/login')) && header('Location: '.$GLOBALS['siteURL'].'admin');
                    break;
                case 'subscriber':
                    header('Location: '.$GLOBALS['siteURL'].'lobby.php');
                    break;
            }
        }
    }

    checkAuth();
?>