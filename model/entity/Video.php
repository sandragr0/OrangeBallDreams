<?php

class Video implements JsonSerializable
{
    private $idVideo;
    private $tipoVideo;
    private $isPublico;
    private $ruta;
    private $idJugador;

    /**
     * @return mixed
     */
    public function getIdVideo()
    {
        return $this->idVideo;
    }

    /**
     * @param mixed $idVideo
     */
    public function setIdVideo($idVideo): void
    {
        $this->idVideo = $idVideo;
    }

    /**
     * @return mixed
     */
    public function getTipoVideo()
    {
        return $this->tipoVideo;
    }

    /**
     * @param mixed $tipoVideo
     */
    public function setTipoVideo($tipoVideo): void
    {
        $this->tipoVideo = $tipoVideo;
    }

    /**
     * @return mixed
     */
    public function getIsPublico()
    {
        return $this->isPublico;
    }

    /**
     * @param mixed $isPublico
     */
    public function setIsPublico($isPublico): void
    {
        $this->isPublico = $isPublico;
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


    public function jsonSerialize()
    {
        return [
            'idVideo' => $this->getIdVideo(),
            'idJugador' => $this->getIdJugador(),
            'ruta' => $this->getRuta(),
            'isPublico' => $this->getIsPublico(),
            'tipoVideo' => $this->getTipoVideo(),
        ];
    }

}