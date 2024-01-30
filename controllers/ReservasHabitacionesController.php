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

    public function formReservas($id=false, $entrada="false", $salida="false", $wrongDate=false) {

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
        
        $this->view->showFormReservas($habitacion, $entrada, $salida, $wrongDate);
    }

    public function noDataFormReservas() {
        
        if(!isset($_GET['entrada']) || !isset($_GET['salida']) ){
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
        }
        
        $entrada = filter_input(INPUT_GET, "entrada");
        $salida = filter_input(INPUT_GET, "salida");
        $wrongDate = false;
        
        if(isset($_GET['wrongDate']) ){   
            $wrongDate = filter_input(INPUT_GET, "wrongDate");
        }
        
        $id = filter_input(INPUT_GET, "id");

        //echo $salida. " bbbb ".$entrada;

        $this->formReservas($id, $entrada, $salida, $wrongDate);
    }
    
    public function submitReserva() {
        //check the session 
        require $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\lib\sesion.php';

        //Variables to check the data
        $entradaCheck = false;
        $salidaCheck = false;

        //If no request by post means no data sended so relocates the user
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
            exit;
        }

        //If no id relocates the user to the page to select one id
        if (!isset($_POST['habitacionId'])) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=noDataSelectAllHotelesAndHabitaciones');
            exit;
        }
        
        //Get the id info
        $id = filter_input(INPUT_POST, "habitacionId");

        //Check if fechaEntrada or fechaSalida is empty or isnt filled
        if (!isset($_POST['fechaEntrada']) || empty($_POST['fechaEntrada']) ) {
            $entradaCheck = true;
        }
        
        if (!isset($_POST['fechaSalida']) || empty($_POST['fechaSalida']) ) {
            $salidaCheck = true;
        }
        
        // var_dump($entradaCheck);
        // var_dump($salidaCheck);
        // exit();
        
        //If fechaEntrada or Fechasalida are true means that no data have been sent or that is empty
        if($entradaCheck === true || $salidaCheck === true){//Relocate the user
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=noDataFormReservas&entrada='.($entradaCheck ? "true" : "false" ).'&salida='.($salidaCheck ? "true" : "false" ) .'&id='.$id);
            exit;
        }
        
        //Save the values from the 
        $fechaEntrada = filter_input(INPUT_POST, "fechaEntrada");
        $fechaSalida = filter_input(INPUT_POST, "fechaSalida");

        // Convert the dates to unix
        $fechaEntrada_unix = strtotime($fechaEntrada);
        $fechaSalida_unix = strtotime($fechaSalida);
        
        //If the date of entrada is before the salida it will show it
        if ($fechaEntrada_unix > $fechaSalida_unix) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=noDataFormReservas&entrada='.$entradaCheck.'&salida='.$salidaCheck.'&id='.$id.'&wrongDate=true');
            exit;
        }

        
        //Get the info from the room
        $habitacion = $this->modelHabitaciones->getHabitacion($id);
        
        $user = $_SESSION['user'];

        try {
            //If the code reaches here means that the info is correct
            $this->modelReservas->addReserva($habitacion, $fechaEntrada, $fechaSalida, $user);
        } catch (Exception $exc) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=addError');
        }

    }
}
