<?php
    //MVC Usuarios
    //require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\controllers\UsuariosController.php';
    //require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\models\UsuariosModel.php';
    //require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\views\UsuariosView.php';
    
    //Bd
    //require_once $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\db\DB.php';
    
    //Create the usuarios controller
    //$usuariosController = new UsuariosController();

    
    //Header of the page
    include $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\views\templates\startBodyTemplate.php';
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\frontcontroller.php';
    
    //Footer of the page
    require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\views\templates\endBodyTemplate.php';

            
            



