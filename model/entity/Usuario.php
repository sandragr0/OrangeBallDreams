<?php

/**
 * Class Usuario
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
 */
class Usuario {
    /**
     * @var
     */
    private $idUsuario;
    /**
     * @var
     */
    private $dni;
    /**
     * @var
     */
    private $nombre;
    /**
     * @var
     */
    private $primerApellido;
    /**
     * @var
     */
    private $segundoApellido;
    /**
     * @var
     */
    private $telefono;
    /**
     * @var
     */
    private $correoElectronico;
    /**
     * @var
     */
    private $contraseña;
    /**
     * @var
     */
    private $nombreUsuario;
    /**
     * @var
     */
    private $fechaCreacion;
    /**
     * @var
     */
    private $fechaAcceso;
    /**
     * @var
     */
    private $activo;
    /**
     * @var
     */
    private $rol;

    /**
     * Function getFullName
     * @return string
     */
    function getFullName()
    {
        if ($this->getSegundoApellido() != "") {
            $apellido2 = " " . $this->getSegundoApellido();
        } else {
            $apellido2 = "";
        }
        return $this->getNombre() . " " . $this->getPrimerApellido() . $apellido2;
    }

    /**
     * Function getIdUsuario
     * @return mixed
     */
    function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Function getDni
     * @return mixed
     */
    function getDni() {
        return $this->dni;
    }

    /**
     * Function getNombre
     * @return mixed
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Function getPrimerApellido
     * @return mixed
     */
    function getPrimerApellido() {
        return $this->primerApellido;
    }

    /**
     * Function getSegundoApellido
     * @return mixed
     */
    function getSegundoApellido() {
        return $this->segundoApellido;
    }

    /**
     * Function getTelefono
     * @return mixed
     */
    function getTelefono() {
        return $this->telefono;
    }

    /**
     * Function getCorreoElectronico
     * @return mixed
     */
    function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    /**
     * Function getContraseña
     * @return mixed
     */
    function getContraseña() {
        return $this->contraseña;
    }

    /**
     * Function getNombreUsuario
     * @return mixed
     */
    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    /**
     * Function getFechaCreacion
     * @return mixed
     */
    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Function getFechaAcceso
     * @return mixed
     */
    function getFechaAcceso() {
        return $this->fechaAcceso;
    }

    /**
     * Function getActivo
     * @return mixed
     */
    function getActivo() {
        return $this->activo;
    }

    /**
     * Function getRol
     * @return mixed
     */
    function getRol() {
        return $this->rol;
    }

    /**
     * Function setIdUsuario
     * @param $idUsuario
     */
    function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    /**
     * Function setDni
     * @param $dni
     */
    function setDni($dni): void {
        $this->dni = $dni;
    }

    /**
     * Function setNombre
     * @param $nombre
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Function setPrimerApellido
     * @param $primerApellido
     */
    function setPrimerApellido($primerApellido): void {
        $this->primerApellido = $primerApellido;
    }

    /**
     * Function setSegundoApellido
     * @param $segundoApellido
     */
    function setSegundoApellido($segundoApellido): void {
        $this->segundoApellido = $segundoApellido;
    }

    /**
     * Function setTelefono
     * @param $telefono
     */
    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    /**
     * Function setCorreoElectronico
     * @param $correoElectronico
     */
    function setCorreoElectronico($correoElectronico): void {
        $this->correoElectronico = $correoElectronico;
    }

    /**
     * Function setContraseña
     * @param $contraseña
     */
    function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    /**
     * Function setNombreUsuario
     * @param $nombreUsuario
     */
    function setNombreUsuario($nombreUsuario): void {
        $this->nombreUsuario = $nombreUsuario;
    }

    /**
     * Function setFechaCreacion
     * @param $fechaCreacion
     */
    function setFechaCreacion($fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * Function setFechaAcceso
     * @param $fechaAcceso
     */
    function setFechaAcceso($fechaAcceso): void {
        $this->fechaAcceso = $fechaAcceso;
    }

    /**
     * Function setActivo
     * @param $activo
     */
    function setActivo($activo): void {
        $this->activo = $activo;
    }

    /**
     * Function setRol
     * @param $rol
     */
    function setRol($rol): void {
        $this->rol = $rol;
    }


}


