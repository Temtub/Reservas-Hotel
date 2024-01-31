<?php

class HotelesModel {
    //Obtain an instance of the BD
    private $bd;
    private $pdo;

    public function __construct() {
       // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Function to show all the hotels
     * @return Array <p>Array of Object Hotel</p>
     */
    public function getHoteles() {
        // Preparamos una consulta de PDO para recuperar todas las tareas de la tabla "hotel" y lo reservamos en una nueva variable
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles');
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitacionesHoteles&action=showError');
        }
        
        
        //Return the usuarios
        return $stmt->fetchAll();
    }

    /**
     * Function to get one hotel
     * @param String $id <p>Id of the hotel to search</p>
     * @return Object <p>Object of class hotel</p>
     * @throws Swoole\MySQL\Exception <p></p>
     */
    public function getOneHotel($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles WHERE id=?');
        
        //Put the id of the hotel we searching
        $stmt->bindParam(1, $id);
                
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Hotel');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            header('Location:' . $_SERVER['PHP_SELF'] . '?controller=ReservasHabitacionesHoteles&action=showError');
        }
        
        //Return the usuarios
        return $stmt->fetchAll();
    }
}