<?php

class ReservasHabitacionesHotelesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $view;
    private $modelReservas;
    private $modelHabitaciones;
    private $modelHoteles;
    
    public function __construct() {
        $this->view = new ReservasHabitacionesHotelesView();
        
        $this->modelReservas = new ReservasModel();
        $this->modelHabitaciones = new HabitacionesModel();
        $this->modelHoteles = new HotelesModel();
    }
    
    /**
     * Function to show all of the reservas
     */
    public function viewAllReservas(){
        
        //Check the session
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        $this->view->introPage();
        
        //Get all the reservas
        $reservas = $this->modelReservas->getReservas();
        
        $user = $_SESSION['user'];
        
        //For each reserva get the ones that are from the user
        foreach ($reservas as $reserva) {
            
            //If the user equals the actual user
            if($reserva->getIdUsuario() == $user->getId() ){
                
                //Get the habitacion of the reserva
                $habitacion = $this->modelHabitaciones->getHabitacion($reserva->getIdHabitacion() );
                
                if ($habitacion) {
                    
                    $hotel = $this->modelHoteles->getOneHotel($habitacion->getIdHotel() );
                    
                    if ($hotel) {
                        $this->view->showReserva($habitacion, $hotel[0], $reserva);
                    } else {
                        // Manejar el caso en que getOneHotel devuelve false
                        $this->view->showMessage('Ha ocurrido un error, pruebe más tarde.');
                    }
                } else {
                    // Manejar el caso en que getHabitacion devuelve false
                    $this->view->showMessage('Ha ocurrido un problema intentelo más tarde.');
                    
                }
            }
        }

    }
    
    public function showError() {
        $this->view->showMessage('Ha ocurrido un erro mostrandote las reservas.', "error");
    }
}