<?php

class Hotel {
    private $id;
    private $nombre;
    private $direccion;
    private $ciudad;
    private $pais;
    private $num_habitaciones;
    private $descripcion;
    private $foto;

    /**
     * Function to transform from mediumblob to the image in the necesary type to show in html
     * @return String <p>An image of in medium blob</p>
     */
    public function getFotoBase64() {
        $fotoBinaryData = $this->getFoto();
        
        $fotoBase64 = base64_encode($fotoBinaryData);
        
        if(empty($fotoBase64) ){
            $imagePath = 'views/assets/images/noPhoto.jpg';

            return $imagePath;
        }
        
        return $fotoBase64;
    }

    // Constructor
    public function __construct() {
       
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getNumHabitaciones() {
        return $this->num_habitaciones;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setNumHabitaciones($num_habitaciones) {
        $this->num_habitaciones = $num_habitaciones;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }
}