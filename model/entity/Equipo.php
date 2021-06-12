<?php

/**
 * Class Equipo
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class Equipo {
    /**
     * @var
     */
    private $idEquipo;
    /**
     * @var
     */
    private $nombre;

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

}
