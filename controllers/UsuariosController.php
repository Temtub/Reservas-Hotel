<?php

class UsuariosController {
    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $model;

    
            
    public function __construct() {
        $this->view = new UsuariosView();
        $this->model = new UsuariosModel();
    }

    // Muestra la lista de tareas
    public function checkUserPass($user, $passw) {
        
        //Variables to check
        $usuEquals = false;
        $passEquals = false;
        $errorBd = false;
        $emptyData = false;
        
        //Get the "usuarios" from the model that gets them from the BD
        try {
            $usuarios = $this->model->getUsuarios();
        } catch (Exception $ex) {
            $errorBd = true;
        }
        
        //Go through all the users from the BD
        foreach ($usuarios as $usuario){
            
            //If the name equals the name that the user wrote in the form turns TRUE the variable and checks if any user has been true checked already
            if(trim($usuario['nombre']) === trim($user) && !$usuEquals){
                $usuEquals = true;
            }
            
            //Check the password and that no password has already checked
            if(password_verify((trim($passw) ), $usuario['contraseña']) && !$passEquals){
                $passEquals = true;
            }
        }
        
        //Check if the data has been sended empty
        if (check_empty_data($user, $passw) ){
            $emptyData = true;
        }
        
        //Show the errors or correct to the user
        $this->view->comprobarLogin($usuEquals, $passEquals, $errorBd, $emptyData);
    }
    
    public function showForm() {
        $this->view->mostrarFormularioLogin();
    }
}