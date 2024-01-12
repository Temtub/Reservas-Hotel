<?php
    //MVC Usuarios
    require_once $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\controllers\UsuariosController.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\models\UsuariosModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\views\UsuariosView.php';
    
    //Bd
    require_once $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\db\DB.php';
    
    //Create the usuarios controller
    $usuariosController = new UsuariosController();
    
    
    
    
    
    /**********************************CHECK FORM************************/
    //Check if form sent any data by post
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //Check the data that has been sent by post
        if(!isset($_POST['user']) ){
            header('Location: '.$_SERVER['PHP_SELF']);
        }
        if(!isset($_POST['pass']) ){
            header('Location: '.$_SERVER['PHP_SELF']);
        }
        
        $user = filter_input(INPUT_POST, 'user');
        $pass = filter_input(INPUT_POST, 'pass');
        
        $usuariosController->checkUserPass($user, $pass);
    }
    /**********************************END CHECK FORM************************/

    

    /****************************SHOW PAGE FORM*******************/
    //Header of the page
    require $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\views\templates\startBodyTemplate.php';
    
    //Show the form
    $usuariosController->showForm();
    
    //Footer of the page
    require $_SERVER['DOCUMENT_ROOT'] . '\reservaHoteles\views\templates\endBodyTemplate.php';
    /****************************END SHOW PAGE FORM*******************/

            
            



