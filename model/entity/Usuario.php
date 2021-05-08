<?php

class Usuario {
    private $idUsuario;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $telefono;
    private $correoElectronico;
    private $contraseña;
    private $usuario;
    private $fechaCreacion;
    private $fechaAcceso;
    private $activo;
    private $rol;
    function getIdUsuario() {
        return $this->idUsuario;
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

    function getUsuario() {
        return $this->usuario;
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

    function setUsuario($usuario): void {
        $this->usuario = $usuario;
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


