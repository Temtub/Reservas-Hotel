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

    // Recupera la lista de tareas de la base de datos
    public function getReservas() {
        // Preparamos una consulta de PDO para recuperar todas las tareas de la tabla "habitaciones" y lo reservamos en una nueva variable
        $stmt = $this->pdo->prepare('SELECT * FROM reservas');

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');

        //If theres an error in this part it throws an exception
        if (!$stmt->execute()) {
            throw new Swoole\MySQL\Exception();
        }

        //Return the usuarios
        return $stmt->fetchAll();
    }

    public function addReserva($habitacion, $fechaEntrada, $fechaSalida, $user) {
        // Preparamos una consulta de PDO para insertar una reserva en la tabla "reservas"
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
            throw new Swoole\MySQL\Exception();
        }
        
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=correctAdd');
        
    }
}
