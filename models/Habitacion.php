<?php

class Habitacion {
    private $id;
    private $id_hotel;
    private $num_habitacion;
    private $tipo;
    private $precio;
    private $descripcion;

    // Constructor
    public function __construct() {
        
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdHotel() {
        return $this->id_hotel;
    }

    public function getNumHabitacion() {
        return $this->num_habitacion;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdHotel($id_hotel) {
        $this->id_hotel = $id_hotel;
    }

    public function setNumHabitacion($num_habitacion) {
        $this->num_habitacion = $num_habitacion;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


    /**
     * Function to show an icon for the type of image
     * @param String $type<p>Type of a room</p>
     */
    public function getTypeIcon($type){

        switch ($type) {
            case 'individual':
                echo '<i class="fa-solid fa-person icon"></i>';
                break;
            case 'doble':
                echo '<i class="fa-solid fa-people-group icon"></i>';
                break;
            case 'suite':
                echo '<i class="fa-solid fa-hotel icon"></i>';
                break;
            default:
                echo '<i class="fa-solid fa-house icon"></i>';
        }
    }


}