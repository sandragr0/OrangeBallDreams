<?php


class Nacionalidad
{
private $idNacionalidad;
private $nombre;
private $icono;

    /**
     * @return mixed
     */
    public function getIdNacionalidad()
    {
        return $this->idNacionalidad;
    }

    /**
     * @param mixed $idNacionalidad
     */
    public function setIdNacionalidad($idNacionalidad): void
    {
        $this->idNacionalidad = $idNacionalidad;
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
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param mixed $icono
     */
    public function setIcono($icono): void
    {
        $this->icono = $icono;
    }

}