<?php

class Jugador
{

    // Atributos
    private $idJugador;
    private $dni;
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
    private $posicion;
    private $visible;
    private $equipo;
    private $ruta;
    private $genero;
    private $nacionalidades;

    function getFullName() {
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
    public function getIdJugador()
    {
        return $this->idJugador;
    }

    /**
     * @param mixed $idJugador
     */
    public function setIdJugador($idJugador): void
    {
        $this->idJugador = $idJugador;
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
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @param mixed $altura
     */
    public function setAltura($altura): void
    {
        $this->altura = $altura;
    }

    /**
     * @return mixed
     */
    public function getExtracomunitario()
    {
        return $this->extracomunitario;
    }

    /**
     * @param mixed $extracomunitario
     */
    public function setExtracomunitario($extracomunitario): void
    {
        $this->extracomunitario = $extracomunitario;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
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
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getBiografia()
    {
        return $this->biografia;
    }

    /**
     * @param mixed $biografia
     */
    public function setBiografia($biografia): void
    {
        $this->biografia = $biografia;
    }

    /**
     * @return mixed
     */
    public function getInforme()
    {
        return $this->informe;
    }

    /**
     * @param mixed $informe
     */
    public function setInforme($informe): void
    {
        $this->informe = $informe;
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
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * @param mixed $posicion
     */
    public function setPosicion($posicion): void
    {
        $this->posicion = $posicion;
    }

    /**
     * @return mixed
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param mixed $visible
     */
    public function setVisible($visible): void
    {
        $this->visible = $visible;
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

    /**
     * @return mixed
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * @param mixed $ruta
     */
    public function setRuta($ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero): void
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getNacionalidades()
    {
        return $this->nacionalidades;
    }

    /**
     * @param mixed $nacionalidades
     */
    public function setNacionalidades($nacionalidades): void
    {
        $this->nacionalidades = $nacionalidades;
    }


}
