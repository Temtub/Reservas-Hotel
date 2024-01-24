<?php

class Reserva {
    private $id;
    private $idUsuario;
    private $idHotel;
    private $idHabitacion;
    private $fechaEntrada;
    private $fechaSalida;

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
        return $this->idUsuario;
    }

    // Setter para $idUsuario
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    // Getter para $idHotel
    public function getIdHotel() {
        return $this->idHotel;
    }

    // Setter para $idHotel
    public function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    // Getter para $idHabitacion
    public function getIdHabitacion() {
        return $this->idHabitacion;
    }

    // Setter para $idHabitacion
    public function setIdHabitacion($idHabitacion) {
        $this->idHabitacion = $idHabitacion;
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
    