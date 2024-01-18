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

    // Recupera la lista de tareas de la base de datos
    public function getHoteles() {
        // Prepare a sql to get all the "hoteles" and save it in a new variable
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            throw new Swoole\MySQL\Exception();
        }
        
        //Return the data of the prepare
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}