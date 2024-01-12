<?php



class UsuariosModel {
    // Obtiene una instancia de PDO para conectarse a la base de datos
    private $bd;
    private $pdo;

    public function __construct() {
       // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    // Recupera la lista de tareas de la base de datos
    public function getUsuarios() {
        // Preparamos una consulta de PDO para recuperar todas las tareas de la tabla "usuarios" y lo reservamos en una nueva variable
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios');
        
        //If theres an error in this part it throws an exception
        if(!$stmt->execute()){
            throw new Swoole\MySQL\Exception();
        }
        
        //Return the usuarios
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}