<?php

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

    // Verificar si la cookie existe
    if (isset($_COOKIE[$cookieName])) {
        // Obtener el valor de la cookie
        $last_login_time = $_COOKIE[$cookieName];

        // Actualizar la cookie con el nuevo tiempo
        setcookie($cookieName, $current_time, $cookieExpirationTime, "/");
    } else {
        // Si la cookie no existe, establecerla por primera vez
        setcookie($cookieName, $current_time, $cookieExpirationTime, "/");
    }
}

function getLastLoginTime() {
    $cookieName = "last_login_time";

    // If the cookie exists
    if(isset($_COOKIE[$cookieName])) {
        // Obtain the value
        $last_login_time = $_COOKIE[$cookieName];

        // Format it so it shows like a date
        $formatted_last_login_time = date("d-m H:i", $last_login_time);

        // Return the value to show it
        return $formatted_last_login_time;
    } else {//f it doesnt exists return no conexion
        return "Primera conexión.";
    }
}