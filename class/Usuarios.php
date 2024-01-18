<?php

class Usuario {
    private $id;
    private $nombre;
    private $contraseña;
    private $fecha_registro;
    private $rol;

    public function __construct($id, $nombre, $contraseña, $fecha_registro, $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
        $this->fecha_registro = $fecha_registro;
        $this->rol = $rol;
    }

    // Getter para ID
    public function getId() {
        return $this->id;
    }

    // Setter para ID
    public function setId($id) {
        $this->id = $id;
    }

    // Getter para Nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para Nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter para Contraseña
    public function getContraseña() {
        return $this->contraseña;
    }

    // Setter para Contraseña
    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    // Getter para Fecha de Registro
    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    // Setter para Fecha de Registro
    public function setFechaRegistro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    // Getter para Rol
    public function getRol() {
        return $this->rol;
    }

    // Setter para Rol
    public function setRol($rol) {
        $this->rol = $rol;
    }
}

