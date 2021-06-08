<?php

class VideoDAO extends BaseDAO
{
    private $nombreTabla = "video";

    public function __construct()
    {
        parent::__construct($this->nombreTabla);
    }

    function view($id)
    {
        return parent::view($id); // TODO: Change the autogenerated stub
    }

    function list()
    {
        return parent::list(); // TODO: Change the autogenerated stub
    }

    function delete($id)
    {
        parent::delete($id); // TODO: Change the autogenerated stub
    }

    function edit($id, object $objeto)
    {
        // TODO: Implement edit() method.
    }

    function add(object $objeto)
    {
        try {
            $stm = $this->conexion->prepare("INSERT INTO `video`(`idJugador`, `tipoVideo`, `isPublico`, `ruta`) VALUES (?,?,?,?)");
            $stm->execute(array(
                $objeto->getIdJugador(),
                $objeto->getTipoVideo(),
                $objeto->getIsPublico(),
                $objeto->getRuta()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getHighlightsFromJugador($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare('SELECT * FROM `video` WHERE idJugador=? and video.tipoVideo="highlight";');
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Video");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getPartidosCompletosFromJugador($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare('SELECT * FROM `video` WHERE idJugador=? and video.tipoVideo="partido";');
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Video");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}