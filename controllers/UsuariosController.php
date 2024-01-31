<?php

class UsuariosController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $model;

    public function __construct() {
        $this->view = new UsuariosView();
        $this->model = new UsuariosModel();
    }

    /**
     * Function to check if the user and password are correct
     */
    public function checkUserPass() {
        try {
            // Check if form sent any data by post
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Validate input data
                $formData = $this->validateFormData();

                // Get the "usuarios" from the model that gets them from the BD
                $usuarios = $this->model->getUsuarios();

                // Check user and password
                $result = $this->checkCredentials($formData, $usuarios);
            
                // Show the errors or correct to the user
                $this->view->comprobarLogin($result['usuEquals'], $result['passEquals'], $result['errorBd'], $formData['emptyData'], $result['usu']);
            }
        } catch (Exception $ex) {
            // Handle exceptions (e.g., database errors)
            $this->view->showErrorPage($ex->getMessage());
        }
    }

    /**
     * Validates if the data sent by the form is empty 
     * @return Array Array with the results of validating the user and password 
     */
    private function validateFormData() {
        $emptyData = false;

        // Check if the data has been sent empty
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            $emptyData = true;
        }

        $user = filter_input(INPUT_POST, 'user');
        $pass = filter_input(INPUT_POST, 'pass');

        //Returns an array of the data to check
        return compact('user', 'pass', 'emptyData');
    }

    /**
     * Function that checks if the user and password are correct in the BD
     * @param Array $formData Array with info of the form
     * @param Array $usuarios Array with the usuarios from the BD
     * @return Array Retruns an array with the varables of checking that all the data has been corrected
     */
    private function checkCredentials($formData, $usuarios) {
        $usuEquals = false;
        $passEquals = false;
        $errorBd = false;
        $usu = '';
        //print_r($usuarios);
        //exit();
        //Travel the loop of users and check if password and user are the same
        foreach ($usuarios as $usuario) {

            if (trim($usuario->getNombre()) === trim($formData['user']) && !$usuEquals) {
                $usuEquals = true;
            }

            $password = hash("SHA256", trim($formData['pass']) );
            
            if ($password === $usuario->getContraseña() && !$passEquals) {
                $passEquals = true;
            }
            
            //if (password_verify(trim($formData['pass']), $usuario->getContraseña()) && !$passEquals) {
            //    $passEquals = true;
            //}

            if ($usuEquals && $passEquals) {
                
                $usu = $usuario;
                
                break;
            }
        }
        
        //Returns an array of the data to check
        return compact('usuEquals', 'passEquals', 'errorBd', 'formData', 'usu');
    }

    /**
     * Calls the view to show the form of login
     */
    public function showForm() {
        $this->view->mostrarFormularioLogin();
    }

    public function denieAcces() {
        $this->view->showMessage('No puedes acceder sin iniciar sesión.', "error", 'noGif.gif');
        $this->view->mostrarFormularioLogin();
    }

    public function closeSession() {

        session_start();

        // Destroy the session
        $_SESSION = array();
        session_destroy();

        // Delete the cookies
        setcookie(session_name(), "", time() - 1000, "/");

        $this->view->showMessage('Se ha cerrado sesión.', "normal", "byeBye.gif");
        $this->view->mostrarFormularioLogin();
    }

    public function noBdConnection() {
        $this->view->showMessage('Estamos en mantenimiento, prueba más tarde.');
        // echo '<img src="\Reservas-Hotel\views\assets\images\sryGid.gif"/>';
        //    $this->view->mostrarFormularioLogin();
    }
}
