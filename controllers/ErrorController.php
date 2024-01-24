<?php

class ErrorController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $model;

    public function __construct() {
        $this->view = new UsuariosView();
        $this->model = new UsuariosModel();
    }


}
