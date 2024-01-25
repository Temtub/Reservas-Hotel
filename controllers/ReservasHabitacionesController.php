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

    public function formReservas($id=false, $entrada="false", $salida="false") {

        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        //Check if id is false, if is false means that comes from the noData
        if(!$id){
            
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
            }

            if (!isset($_POST['habitacionId'])) {
                header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
            }
            
            $id = filter_input(INPUT_POST, "habitacionId");
        }


        $habitacion = $this->modelHabitaciones->getHabitacion($id);

        $this->view->showFormReservas($habitacion[0], $entrada, $salida);
    }

    public function noDataFormReservas() {
        if(!isset($_GET['entrada']) || !isset($_GET['salida']) ){
            //header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
        }
        
        $entrada = filter_input(INPUT_GET, "entrada");
        $salida = filter_input(INPUT_GET, "salida");
        
        $id = filter_input(INPUT_GET, "id");

        //echo $salida. " bbbb ".$entrada;

        
        $this->formReservas($id, $entrada, $salida);
    }
    
    public function submitReserva() {
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        //Variables to check the data
        $entradaCheck = "false";
        $salidaCheck = "false";

        //If no request by post means no data sended so relocates the user
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
        }

        //If no id relocates the user to the page to select one id
        if (!isset($_POST['habitacionId'])) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
        }
        
        //Get the id info
        $id = filter_input(INPUT_POST, "habitacionId");

        //Check if fechaEntrada or fechaSalida is empty or isnt filled
        if (!isset($_POST['fechaEntrada']) || empty($_POST['fechaEntrada']) ) {
            $entradaCheck = "true";
        }
        
        if (!isset($_POST['fechaSalida']) || empty($_POST['fechaSalida'])) {
            $salidaCheck = "true";
        }
        
        //If fechaEntrada or Fechasalida are true means that no data have been sent or that is empty
        if($entradaCheck==="true" || $salidaCheck==="true"){//Relocate the user
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=noDataFormReservas&entrada='.$entradaCheck.'&salida='.$salidaCheck.'&id='.$id);
        }
        
        //Save the values from the 
        $fechaEntrada = filter_input(INPUT_POST, "fechaEntrada");
        $fechaSalida = filter_input(INPUT_POST, "fechaSalida");
        
        //Get the info from the room
        $habitacion = $this->modelHabitaciones->getHabitacion($id);
        
        $user = $_SESSION['user'];
                
        //If the code reaches here means that the info is correct
        $this->modelReservas->addReserva($habitacion, $fechaEntrada, $fechaSalida, $user);
    }
}
