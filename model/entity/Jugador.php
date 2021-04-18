<?php

class Jugador {

    // Atributos
    private $idjugador;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $apellidos;
    private $altura;
    private $extracomunitario;
    private $fechaNac;
    private $telefono;
    private $estado;
    private $biografia;
    private $informe;
    private $idEquipo;

    // Getters y setters
    function getIdjugador() {
        return $this->idjugador;
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

    function getFechaNac() {
        return $this->fechaNac;
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

    function setIdjugador($idjugador): void {
        $this->idjugador = $idjugador;
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

    function setFechaNac($fechaNac): void {
        $this->fechaNac = $fechaNac;
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

}
