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
    
    public function viewAllReservas(){
        
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        //Get all the reservas
        $reservas = $this->modelReservas->getReservas();
        
        $user = $_SESSION['user'];
        
        //For each reserva get the ones that are from the user
        foreach ($reservas as $reserva) {
            
            //If the user equals the actual user
            if($reserva->getIdUsuario() == $user->getId() ){
                
                //Get the habitacion of the reserva
                $habitacion = $this->modelHabitaciones->getHabitacion($reserva->getId() );
                
                if ($habitacion) {
                    
                    $hotel = $this->modelHoteles->getOneHotel($habitacion->getIdHotel() );
                    
                    if ($hotel) {
                        $this->view->showReserva($habitacion, $hotel[0], $reserva);
                    } else {
                        // Manejar el caso en que getOneHotel devuelve false
                        $this->view->showMessage('No se ha podido obtener la información del hotel.');
                    }
                } else {
                    // Manejar el caso en que getHabitacion devuelve false
                    $this->view->showMessage('Ha ocurrido un problema.');
                    exit;
                }
            }
        }

    }
}