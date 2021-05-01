<?php

class Jugador {

    // Atributos
    private $idJugador;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $apellidos;
    private $altura;
    private $extracomunitario;
    private $fechaNacimiento;
    private $telefono;
    private $estado;
    private $biografia;
    private $informe;
    private $idEquipo;
    private $nombreEquipo;

    // Getters y setters
    function getIdJugador() {
        return $this->idJugador;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrimerApellido() {
        return $this->primerApellido;
    }

    function getSegundoApellido() {
        return $this->segundoApellido;
    }

    function getApellidos() {
        return $this->primerApellido . " " . $this->segundoApellido;
    }

    function getAltura() {
        return $this->altura;
    }

    function getExtracomunitario() {
        return $this->extracomunitario;
    }

    function getfechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEstado() {
        return $this->estado;
    }

    function getBiografia() {
        return $this->biografia;
    }

    function getInforme() {
        return $this->informe;
    }

    function getIdEquipo() {
        return $this->idEquipo;
    }

    function getNombreEquipo() {
        return $this->nombreEquipo;
    }

    function setIdjugador($idJugador): void {
        $this->idJugador = $idJugador;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setPrimerApellido($primerApellido): void {
        $this->primerApellido = $primerApellido;
    }

    function setSegundoApellido($segundoApellido): void {
        $this->segundoApellido = $segundoApellido;
    }

    function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    function setAltura($altura): void {
        $this->altura = $altura;
    }

    function setExtracomunitario($extracomunitario): void {
        $this->extracomunitario = $extracomunitario;
    }

    function setfechaNacimiento($fechaNac): void {
        $this->fechaNacimiento = fechaNacimiento;
    }

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setEstado($estado): void {
        $this->estado = $estado;
    }

    function setBiografia($biografia): void {
        $this->biografia = $biografia;
    }

    function setInforme($informe): void {
        $this->informe = $informe;
    }

    function setIdEquipo($idEquipo): void {
        $this->idEquipo = $idEquipo;
    }

    function setNombreEquipo($nombreEquipo): void {
        $this->nombreEquipo = $nombreEquipo;
    }

}
