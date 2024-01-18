
<?php

class HotelesHabitacionesController {

    // Obtiene una instancia del modelo y de la vista de tareas
    private $viewHotel;
    private $modelHotel;
    
    private $viewHabitacion;
    private $modelHabitacion;

    public function __construct() {
        $this->viewHotel = new HotelesView();
        $this->modelHotel = new HotelesModel();
        
        $this->viewHabitacion = new HabitacionesView();
        $this->modelHabitacion = new HabitacionesModel();
    }
    
    public function selectAllHotelesAndHabitaciones() {
        //session check
        //require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        $hoteles = $this->modelHotel->getHoteles();
        
        $this->viewHotel->showHotels($hoteles);
        
       echo 'hola';
        
    }


    
}

