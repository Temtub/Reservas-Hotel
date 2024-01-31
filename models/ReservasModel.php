<?php

class ReservasModel {

    //Obtain an instance of the BD
    private $bd;
    private $pdo;

    public function __construct() {
        // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Get all of the reservas from the bd
     * @return Array <p>Array of objects Reserva</p>
     */
    public function getReservas() {
        
        $stmt = $this->pdo->prepare('SELECT * FROM reservas');
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');
    
        //If theres an error in this part it throws an exception
        if (!$stmt->execute()) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=errorOcurred');
        }
        
        //Return the reservas
        return $stmt->fetchAll();
    }
    

    /**
     * Function to add a Reserva to the BD
     * @param type $habitacion <p>$id of the room you want to add</p>
     * @param type $fechaEntrada <p> fecha of the entering of reserva</p>
     * @param type $fechaSalida <p>date of exit of reserva </p>
     * @param type $user <p>user of the reserva</p>
     * @throws Swoole\MySQL\Exception <p>exception for the execute</p>
     */
    public function addReserva($habitacion, $fechaEntrada, $fechaSalida, $user) {
        //Prepare the statement to create a reserva 
        $stmt = $this->pdo->prepare('INSERT INTO `reservas` (`id_usuario`, `id_hotel`, `id_habitacion`, `fecha_entrada`, `fecha_salida`) VALUES (?, ?, ?, ?, ?)');

        $habitacionId = $habitacion->getId();
        $userId = $user->getId();
        $hotelId = $habitacion->getIdHotel();
        
        // Vincula los parámetros a los marcadores de posición en la consulta preparada
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $hotelId);
        $stmt->bindParam(3, $habitacionId);
        $stmt->bindParam(4, $fechaEntrada);
        $stmt->bindParam(5, $fechaSalida);

        // Ejecuta la consulta preparada
        if (!$stmt->execute()) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=errorOcurred');
        }
            
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=correctAdd');
        
    }
    
    /**
     * Function to check that the reserva isnt already created
     * @param String $id <p>Id of the room</p>
     * @param String $fechaEntrada <p>Date of the entry</p>
     * @param String $fechaSalida <p>Date of the exit</p>
     * @param String $user <p>Id of the user</p>
     * @return Bool <p>Returns true if already create or false if not find</p>
     */
    public function comprobarReserva($id, $fechaEntrada, $fechaSalida, $user) {

        $stmt = $this->pdo->prepare('SELECT * FROM reservas WHERE id_habitacion=? AND fecha_entrada=? AND fecha_salida=? AND id_usuario=?');
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');

        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $fechaEntrada);
        $stmt->bindParam(3, $fechaSalida);
        $stmt->bindParam(4, $user);

        if (!$stmt->execute()) {
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitaciones&action=errorOcurred');

        }

        //Get the row of the result
        $result = $stmt->fetch();

        //Return true if find any row, else returns false
        return ($result !== false);
    }


}
