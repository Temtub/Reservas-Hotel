<?php

class ReservasHabitacionesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $modelReservas;
    private $modelHabitaciones;


    public function __construct() {
        $this->view = new ReservasHabitacionesView();
        $this->modelReservas = new ReservasModel();
        $this->modelHabitaciones = new HabitacionesModel();

    }
    
    public function formReservas(){
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:'. $_SERVER['PHP_SELF'] .'?controller=Usuarios&action=selectAllHotelesAndHabitaciones');
        }
        
        $habitaciones = $this->modelHabitaciones->getHabitaciones();
        
        $this->view->showFormReservas($habitaciones);
        
    }
    
}