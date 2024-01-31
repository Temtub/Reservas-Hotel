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

    /**
     * Function to show the form to make a Reserva
     * @param Integer $id <p>Id of the room you want to show, its necessary if it is not passed by post</p>
     * @param String $entrada <p>Variable that says if the entering date is wrong</p>
     * @param String $salida <p>Variable that says if the exiting date is wrong</p>
     * @param Bool $wrongDate <p>Variable that says if the date is wrong</p>
     */
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

    /**
     * Function to show that the Form havent recived any data
     */
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
    
    
    /**
     * Function in charge of creating the Reservas
     */
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
        $fechaActual_unix = strtotime(date("Y-m-d"));
        
        //If the date of entrada is before the salida it will show it
        if ($fechaEntrada_unix > $fechaSalida_unix) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=noDataFormReservas&entrada='.$entradaCheck.'&salida='.$salidaCheck.'&id='.$id.'&wrongDate=true');
            exit;
        }

        if ($fechaEntrada_unix < $fechaActual_unix) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=fechaEntradaPasada&id='.$id);
            exit;
        }
        
        //Obtain the room and user
        $habitacion = $this->modelHabitaciones->getHabitacion($id);
        $user = $_SESSION['user'];

        // Check if theres already that reserva
        $checkReserva = $this->modelReservas->comprobarReserva($id, $fechaEntrada, $fechaSalida, $user->getId());

        // If theres that reserva returns to page
        if ($checkReserva) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=showDuplicateReserva&id=' . $id);
            exit;
        }

        // Create a Reserva
        try {
            $this->modelReservas->addReserva($habitacion, $fechaEntrada, $fechaSalida, $user);
        } catch (Exception $exc) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=addError');
            exit;
        }

    }//END SUBMIT RESERVA
    
    /**
     * Function to show that theres already that Reserva
     */
    public function showDuplicateReserva() {
        
        $id = false;
        
        if(isset($_GET['id']) ){
            $id = filter_input(INPUT_GET, "id");
        }
        
        $this->view->showMessage('Ya tienes esa reserva esos días', "error");
        $this->formReservas($id);
        
    }
    
    /**
     * Function to show that theres already that Reserva
     */
    public function errorOcurred() {
        
        $id = false;
        
        if(isset($_GET['id']) ){
            $id = filter_input(INPUT_GET, "id");
        }
        
        $this->view->showMessage('Ha ocurrido un error, pruebe más tarde.', "error");
        $this->formReservas($id);
        
    }
    
    public function fechaEntradaPasada() {
        $id = false;
        
        if(isset($_GET['id']) ){
            $id = filter_input(INPUT_GET, "id");
        }
        
        $this->view->showMessage('La fecha de entrada ha de ser mayor que hoy.', "error");
        $this->formReservas($id);
    }
}
