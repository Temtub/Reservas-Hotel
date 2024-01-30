<?php

    //Check if the user has registered
    session_start();
    if(!isset($_SESSION["user"])){
        header('Location: '.$_SERVER['PHP_SELF'].'?controller=Usuarios&action=denieAcces');
    }
    
    $user = $_SESSION['user'];
    
    updateLastLoginTime();
        
    
