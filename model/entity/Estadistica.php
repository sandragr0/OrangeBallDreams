<?php


/**
 * Class Estadistica
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
 */
class Estadistica implements JsonSerializable
{
    /**
     * @var
     */
    private $idEstadistica;
    /**
     * @var
     */
    private $idJugador;
    /**
     * @var
     */
    private $nombreEquipo;
    /**
     * @var
     */
    private $nombreLiga;
    /**
     * @var
     */
    private $PPP;
    /**
     * @var
     */
    private $APP;
    /**
     * @var
     */
    private $RPP;
    /**
     * @var
     */
    private $porcentajeDobles;
    /**
     * @var
     */
    private $porcentajeTriples;
    /**
     * @var
     */
    private $MIN;
    /**
     * @var
     */
    private $porcentajeTL;
    /**
     * @var
     */
    private $ROB;
    /**
     * @var
     */
    private $TAP;
    /**
     * @var
     */
    private $temporada;


    /**
     * Function getIdEstadistica
     * @return mixed
     */
    public function getIdEstadistica()
    {
        return $this->idEstadistica;
    }


    /**
     * Function setIdEstadistica
     * @param $idEstadistica
     */
    public function setIdEstadistica($idEstadistica): void
    {
        $this->idEstadistica = $idEstadistica;
    }


    /**
     * Function getIdJugador
     * @return mixed
     */
    public function getIdJugador()
    {
        return $this->idJugador;
    }


    /**
     * Function setIdJugador
     * @param $idJugador
     */
    public function setIdJugador($idJugador): void
    {
        $this->idJugador = $idJugador;
    }


    /**
     * Function getNombreEquipo
     * @return mixed
     */
    public function getNombreEquipo()
    {
        return $this->nombreEquipo;
    }


    /**
     * Function setNombreEquipo
     * @param $nombreEquipo
     */
    public function setNombreEquipo($nombreEquipo): void
    {
        $this->nombreEquipo = $nombreEquipo;
    }


    /**
     * Function getNombreLiga
     * @return mixed
     */
    public function getNombreLiga()
    {
        return $this->nombreLiga;
    }


    /**
     * Function setNombreLiga
     * @param $nombreLiga
     */
    public function setNombreLiga($nombreLiga): void
    {
        $this->nombreLiga = $nombreLiga;
    }


    /**
     * Function getPPP
     * @return mixed
     */
    public function getPPP()
    {
        return $this->PPP;
    }


    /**
     * Function setPPP
     * @param $PPP
     */
    public function setPPP($PPP): void
    {
        $this->PPP = $PPP;
    }


    /**
     * Function getAPP
     * @return mixed
     */
    public function getAPP()
    {
        return $this->APP;
    }


    /**
     * Function setAPP
     * @param $APP
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
     * @return string
     */
    public function getPorcentajeDoblesWithSimbolo()
    {
        return $this->porcentajeDobles . "%";
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
     * @return mixed
     */
    public function getPorcentajeTriplesWithSimbolo()
    {
        return $this->porcentajeTriples . "%";
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
     * @return mixed
     */
    public function getPorcentajeTLWithSimbolo()
    {
        return $this->porcentajeTL . "%";
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


    /**
     * Function jsonSerialize
     * @return array
     */
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
            'porcentajeDobles' => $this->getPorcentajeDoblesWithSimbolo(),
            'porcentajeTriples' => $this->getPorcentajeTriplesWithSimbolo(),
            'MIN' => $this->getMIN(),
            'porcentajeTL' => $this->getPorcentajeTLWithSimbolo(),
            'ROB' => $this->getROB(),
            'TAP' => $this->getTAP(),
            'temporada' => $this->getTemporada()
        ];
    }

}