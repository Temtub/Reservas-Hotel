<?php

//Check if the user has registered
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../../index.php?redirected=true");
    }
    $user = $_SESSION['user'];
    
    if($user->getRol() !== 1){
        header("Location: ../../index.php?redirected=true");
    }
    
    updateLastLoginTime();
    
    
    /**
 * Function to check if the user has been inactive for more than 5 minutes or 1 hour
 * 
 * @param integer $last_activity Last time of activity user  
 *
 */
function updateLastLoginTime() {
    // Obtener la hora actual
    $current_time = time();
    
    $cookieName = "last_login_time";//The cookie name

    $cookieExpirationTime = $current_time + (7 * 24 * 60 * 60); // 1 week

    //Set the cookie with the values
    setcookie($cookieName, $current_time, $cookieExpirationTime, "/");
}