
<?php

/**
 * Controller for the Hoteles and Habitaciones
 */
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
    
    /**
     * Function to show all the hotels with his rooms
     */
    public function selectAllHotelesAndHabitaciones() {
               
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        $hoteles = $this->modelHotel->getHoteles();
        $habitaciones = $this->modelHabitacion->getHabitaciones();
        
        $this->viewHotelHabitaciones->showHotelsRooms($hoteles, $habitaciones);
        
    }
    
    /**
     * Function to show that there is no data selected
     */
    public function noDataSelectAllHotelesAndHabitaciones() {
               
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        $hoteles = $this->modelHotel->getHoteles();
        $habitaciones = $this->modelHabitacion->getHabitaciones();
        
        $this->viewHotelHabitaciones->noDataShowHotelRooms($hoteles, $habitaciones);
        
    }
    
    
    /**
     * Function to show all a hotel and its rooms
     */
    public function showHotelAndRooms() {
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';
        
        
        try {
            // Check if form sent any data by post
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if(isset($_POST['idHotel']) ){
                    
                    //Get the id from post
                    $id = filter_input(INPUT_POST, 'idHotel');
                    
                    //Select the info of the hotel
                    $hotel = $this->modelHotel->getOneHotel($id);
                    
                    //Get all rooms from that hotel
                    $habitaciones = $this->modelHabitacion->gethabitacionesFromHotel($id);
                    
                    //Show the hotel and the rooms
                    $this->viewHotelHabitaciones->showHotelAndRooms($hotel[0], $habitaciones);

                }
                else{
                    $this->errorShowinHotel();
                }
                
            }
        } catch (Exception $ex) {
            // Handle exceptions (e.g., database errors)
            $this->viewHotelHabitaciones->showMessage('Ha ocurrido un error mostrando el hotel.', "error");
        }
           
    }
    /**
     * Function to show that there was an error in the page of showing an hotel
     */
    public function errorShowinHotel() {
        $this->viewHotelHabitaciones->showMessage('Ha ocurrido un problema, vuelve a intentarlo.', "error");
        $this->selectAllHotelesAndHabitaciones();
    }
    /**
     * Function to show that there was an error doing the Reserva
     */
    public function addError() {
        $this->viewHotelHabitaciones->showMessage('Ha ocurrido un error haciendo la reserva, vuelve a intentarlo.');
        
        $this->selectAllHotelesAndHabitaciones();
    }
    
    
    /**
     * Function to show that the Reserva was correctly added
     */
    public function correctAdd() {
        $this->viewHotelHabitaciones->showMessage('Se ha ejecutado correctamente la reserva.', "correct");

        $this->selectAllHotelesAndHabitaciones();
    }
}

