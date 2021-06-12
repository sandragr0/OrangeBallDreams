<?php

/**
 * Class EstadisticaDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class EstadisticaDAO extends BaseDAO
{
    /**
     * @var string
     */
    private $nombreTabla = "estadistica";

    /**
     * EstadisticaDAO constructor.
     */
    public function __construct()
    {
        parent::__construct($this->nombreTabla);
    }

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
    function view($id)
    {
        return parent::view($id); // TODO: Change the autogenerated stub
    }

    /**
     * Function list
     * @return array|null
     */
    function list()
    {
        return parent::list();
    }

    /**
     * Function delete
     * @param object $id
     */
    function delete($id)
    {
        parent::delete($id); // TODO: Change the autogenerated stub
    }

    /**
     * Function edit
     * @param $id
     * @param object $objeto
     * @return mixed|void
     */
    function edit($id, object $objeto)
    {
        try {
            $stm = $this->conexion->prepare("UPDATE `estadistica` set `idJugador`=?, `nombreEquipo`=?, `nombreLiga`=?, `PPP`=?, `APP`=?, `RPP`=?, `porcentajeDobles`=?, `porcentajeTriples`=?, `MIN`=?, `porcentajeTL`=?, `ROB`=?, `TAP`=?, `temporada`=? where idEstadistica=?");
            $stm->execute(array(
                $objeto->getIdJugador(),
                $objeto->getNombreEquipo(),
                $objeto->getNombreLiga(),
                $objeto->getPPP(),
                $objeto->getAPP(),
                $objeto->getRPP(),
                $objeto->getPorcentajeDobles(),
                $objeto->getPorcentajeTriples(),
                $objeto->getMIN(),
                $objeto->getPorcentajeTL(),
                $objeto->getROB(),
                $objeto->getTAP(),
                $objeto->getTemporada(),
                $id
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function add
     * @param object $objeto
     * @return mixed|void
     */
    function add(object $objeto)
    {
        try {
            $stm = $this->conexion->prepare("INSERT INTO `estadistica`(`idJugador`, `nombreEquipo`, `nombreLiga`, `PPP`, `APP`, `RPP`, `porcentajeDobles`, `porcentajeTriples`, `MIN`, `porcentajeTL`, `ROB`, `TAP`, `temporada`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stm->execute(array(
                $objeto->getIdJugador(),
                $objeto->getNombreEquipo(),
                $objeto->getNombreLiga(),
                $objeto->getPPP(),
                $objeto->getAPP(),
                $objeto->getRPP(),
                $objeto->getPorcentajeDobles(),
                $objeto->getPorcentajeTriples(),
                $objeto->getMIN(),
                $objeto->getPorcentajeTL(),
                $objeto->getROB(),
                $objeto->getTAP(),
                $objeto->getTemporada()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getJugadoresWithEstadistica
     * @param $id
     * @return array|null
     */
    public function getJugadoresWithEstadistica($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM estadistica where idJugador=?;");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Estadistica");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}