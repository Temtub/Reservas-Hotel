<?php

class HabitacionesModel {
    //Obtain an instance of the BD
    private $bd;
    private $pdo;

    public function __construct() {
       // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
      $this->bd = new DB();
      $this->pdo = $this->bd->getPDO();
    }

    // Recupera la lista de tareas de la base de datos
    public function getHabitaciones() {
        // Preparamos una consulta de PDO para recuperar todas las tareas de la tabla "habitaciones" y lo reservamos en una nueva variable
        $stmt = $this->pdo->prepare('SELECT * FROM habitaciones');
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            throw new Swoole\MySQL\Exception();
        }
        
        //Return the usuarios
        return $stmt->fetchAll();
    }
    
    public function gethabitacionesFromHotel($idHotel) {
        // Preparamos una consulta de PDO para recuperar todas "habitaciones" de un hotel y lo reservamos en una nueva variable
        $stmt = $this->pdo->prepare('SELECT * FROM habitaciones WHERE id_hotel=?');
        
        //Put the id of the hotel we searching
        $stmt->bindParam(1, $idHotel);
                
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Habitacion');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            throw new Swoole\MySQL\Exception();
        }
        
        //Return the usuarios
        return $stmt->fetchAll();
    }
}