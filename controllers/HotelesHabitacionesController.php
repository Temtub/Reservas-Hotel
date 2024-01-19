
<?php

class HotelesHabitacionesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $modelHotel;
    private $modelHabitacion;
    
    private $viewHotelHabitaciones;

    public function __construct() {
        $this->modelHotel = new HotelesModel();
        $this->modelHabitacion = new HabitacionesModel();
        
        $this->viewHotelHabitaciones = new HotelesHabitacionesView();
    }
    
    public function selectAllHotelesAndHabitaciones() {
               
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        $hoteles = $this->modelHotel->getHoteles();
        $habitaciones = $this->modelHabitacion->getHabitaciones();
        
        $this->viewHotelHabitaciones->showHotelsRooms($hoteles, $habitaciones);
        
    }
    
    public function showHotelAndRooms() {
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';
        
        
        try {
            // Check if form sent any data by post
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                
            }
        } catch (Exception $ex) {
            // Handle exceptions (e.g., database errors)
            $this->view->showErrorPage($ex->getMessage());
        }
           
        $this->viewHotelHabitaciones->showHotelAndRooms();
    }
    
}

