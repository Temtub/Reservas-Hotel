<?php

class Reserva {

    private $id;
    private $id_usuario;
    private $id_hotel;
    private $id_habitacion;
    private $fecha_entrada;
    private $fecha_salida;

    // Getter para $id
    public function getId() {
        return $this->id;
    }

    // Setter para $id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter para $idUsuario
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    // Setter para $idUsuario
    public function setIdUsuario($idUsuario) {
        $this->id_usuario = $idUsuario;
    }

    // Getter para $idHotel
    public function getIdHotel() {
        return $this->id_usuario;
    }

    // Setter para $idHotel
    public function setIdHotel($idHotel) {
        $this->id_usuario = $idHotel;
    }

    // Getter para $idHabitacion
    public function getIdHabitacion() {
        return $this->id_habitacion;
    }

    // Setter para $idHabitacion
    public function setIdHabitacion($idHabitacion) {
        $this->id_habitacion = $idHabitacion;
    }

    // Getter para $fechaEntrada
    public function getFechaEntrada() {
        return $this->fechaEntrada;
    }

    // Setter para $fechaEntrada
    public function setFechaEntrada($fechaEntrada) {
        $this->fechaEntrada = $fechaEntrada;
    }

    // Getter para $fechaSalida
    public function getFechaSalida() {
        return $this->fechaSalida;
    }

    // Setter para $fechaSalida
    public function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;
    }
}
