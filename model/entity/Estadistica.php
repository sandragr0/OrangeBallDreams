<?php

class Estadistica implements JsonSerializable
{
    private $idEstadistica;
    private $idJugador;
    private $nombreEquipo;
    private $nombreLiga;
    private $PPP;
    private $APP;
    private $RPP;
    private $porcentajeDobles;
    private $porcentajeTriples;
    private $MIN;
    private $porcentajeTL;
    private $ROB;
    private $TAP;
    private $temporada;

    /**
     * @return mixed
     */
    public function getIdEstadistica()
    {
        return $this->idEstadistica;
    }

    /**
     * @param mixed $idEstadistica
     */
    public function setIdEstadistica($idEstadistica): void
    {
        $this->idEstadistica = $idEstadistica;
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
    public function getNombreEquipo()
    {
        return $this->nombreEquipo;
    }

    /**
     * @param mixed $nombreEquipo
     */
    public function setNombreEquipo($nombreEquipo): void
    {
        $this->nombreEquipo = $nombreEquipo;
    }

    /**
     * @return mixed
     */
    public function getNombreLiga()
    {
        return $this->nombreLiga;
    }

    /**
     * @param mixed $nombreLiga
     */
    public function setNombreLiga($nombreLiga): void
    {
        $this->nombreLiga = $nombreLiga;
    }

    /**
     * @return mixed
     */
    public function getPPP()
    {
        return $this->PPP;
    }

    /**
     * @param mixed $PPP
     */
    public function setPPP($PPP): void
    {
        $this->PPP = $PPP;
    }

    /**
     * @return mixed
     */
    public function getAPP()
    {
        return $this->APP;
    }

    /**
     * @param mixed $APP
     */
    public function setAPP($APP): void
    {
        $this->APP = $APP;
    }

    /**
     * @return mixed
     */
    public function getRPP()
    {
        return $this->RPP;
    }

    /**
     * @param mixed $RPP
     */
    public function setRPP($RPP): void
    {
        $this->RPP = $RPP;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeDobles()
    {
        return $this->porcentajeDobles;
    }

    /**
     * @param mixed $porcentajeDobles
     */
    public function setPorcentajeDobles($porcentajeDobles): void
    {
        $this->porcentajeDobles = $porcentajeDobles;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeTriples()
    {
        return $this->porcentajeTriples;
    }

    /**
     * @param mixed $porcentajeTriples
     */
    public function setPorcentajeTriples($porcentajeTriples): void
    {
        $this->porcentajeTriples = $porcentajeTriples;
    }

    /**
     * @return mixed
     */
    public function getMIN()
    {
        return $this->MIN;
    }

    /**
     * @param mixed $MIN
     */
    public function setMIN($MIN): void
    {
        $this->MIN = $MIN;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeTL()
    {
        return $this->porcentajeTL;
    }

    /**
     * @param mixed $porcentajeTL
     */
    public function setPorcentajeTL($porcentajeTL): void
    {
        $this->porcentajeTL = $porcentajeTL;
    }

    /**
     * @return mixed
     */
    public function getROB()
    {
        return $this->ROB;
    }

    /**
     * @param mixed $ROB
     */
    public function setROB($ROB): void
    {
        $this->ROB = $ROB;
    }

    /**
     * @return mixed
     */
    public function getTAP()
    {
        return $this->TAP;
    }

    /**
     * @param mixed $TAP
     */
    public function setTAP($TAP): void
    {
        $this->TAP = $TAP;
    }

    /**
     * @return mixed
     */
    public function getTemporada()
    {
        return $this->temporada;
    }

    /**
     * @param mixed $temporada
     */
    public function setTemporada($temporada): void
    {
        $this->temporada = $temporada;
    }


    public function jsonSerialize()
    {
        return [
            'idEstadistica' => $this->getIdEstadistica(),
            'idJugador' => $this->getIdJugador(),
            'nombreEquipo' => $this->getNombreEquipo(),
            'nombreLiga' => $this->getNombreLiga(),
            'PPP' => $this->getPPP(),
            'APP' => $this->getAPP(),
            'RPP' => $this->getRPP(),
            'porcentajeDobles' => $this->getPorcentajeDobles(),
            'porcentajeTriples' => $this->getPorcentajeTriples(),
            'MIN' => $this->getMIN(),
            'porcentajeTL' => $this->getPorcentajeTL(),
            'ROB' => $this->getROB(),
            'TAP' => $this->getTAP(),
            'temporada' => $this->getTemporada()
        ];
    }

}