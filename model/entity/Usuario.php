<?php

class Usuario {
    private $idUsuario;
    private $dni;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $telefono;
    private $correoElectronico;
    private $contraseña;
    private $nombreUsuario;
    private $fechaCreacion;
    private $fechaAcceso;
    private $activo;
    private $rol;

    function getFullName()
    {
        if ($this->getSegundoApellido() != "") {
            $apellido2 = " " . $this->getSegundoApellido();
        } else {
            $apellido2 = "";
        }
        return $this->getNombre() . " " . $this->getPrimerApellido() . $apellido2;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getDni() {
        return $this->dni;
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

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    function getContraseña() {
        return $this->contraseña;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getFechaAcceso() {
        return $this->fechaAcceso;
    }

    function getActivo() {
        return $this->activo;
    }

    function getRol() {
        return $this->rol;
    }

    function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    function setDni($dni): void {
        $this->dni = $dni;
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

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setCorreoElectronico($correoElectronico): void {
        $this->correoElectronico = $correoElectronico;
    }

    function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    function setNombreUsuario($nombreUsuario): void {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setFechaCreacion($fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setFechaAcceso($fechaAcceso): void {
        $this->fechaAcceso = $fechaAcceso;
    }

    function setActivo($activo): void {
        $this->activo = $activo;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }


}


