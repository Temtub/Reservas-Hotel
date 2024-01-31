<?php

class ErrorController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;

    public function __construct() {
        $this->view = new ErrorView();
       
    }

    public function noBd() {
        $this->view->showMessage('Estamos trabajando en ello, vuelve más tarde.', 'normal', "working.gif");
    }
    
    public function noController() {
        $this->view->showMessage('Uy algo salió mal, lo sentimos mucho.', 'normal', "noController.gif");
    }
}
