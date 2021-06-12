<?php

/**
 * Class Contacto
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class Contacto
{
    /**
     * @var
     */
    private $idContacto;
    /**
     * @var
     */
    private $nota;
    /**
     * @var
     */
    private $idEquipo;
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
    private $equipo;

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
     * @return mixed
     */
    public function getIdContacto()
    {
        return $this->idContacto;
    }

    /**
     * @param mixed $idContacto
     */
    public function setIdContacto($idContacto): void
    {
        $this->idContacto = $idContacto;
    }

    /**
     * @return mixed
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * @param mixed $nota
     */
    public function setNota($nota): void
    {
        $this->nota = $nota;
    }

    /**
     * @return mixed
     */
    public function getIdEquipo()
    {
        return $this->idEquipo;
    }

    /**
     * @param mixed $idEquipo
     */
    public function setIdEquipo($idEquipo): void
    {
        $this->idEquipo = $idEquipo;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * @param mixed $primerApellido
     */
    public function setPrimerApellido($primerApellido): void
    {
        $this->primerApellido = $primerApellido;
    }

    /**
     * @return mixed
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * @param mixed $segundoApellido
     */
    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundoApellido = $segundoApellido;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * @param mixed $equipo
     */
    public function setEquipo($equipo): void
    {
        $this->equipo = $equipo;
    }


}