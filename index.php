<?php

    //For cookies like last connection
    include $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\cookies.php';
    
    //Header of the page
    include $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\views\templates\startBodyTemplate.php';

    //Front controller
    require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\frontcontroller.php';
    
    //Footer of the page
    require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\views\templates\endBodyTemplate.php';

            
            



