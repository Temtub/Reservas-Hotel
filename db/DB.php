<?php

class DB{
    private $pdo;
    
    public function __construct() {
        //Select the information from the config file
        require_once $_SERVER['DOCUMENT_ROOT'] . '\Reservas-Hotel\config\Config.php';

        //Select the data from the config archive
        require_once 'config/Config.php';
        try {
            // Crea una instancia de PDO para conectarse a la base de datos
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Obtiene una instancia de PDO
    public function getPDO() {
        return $this->pdo;
    }

}
