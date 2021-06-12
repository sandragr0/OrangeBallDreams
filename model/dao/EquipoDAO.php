<?php

/**
 * Class EquipoDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
 */
class EquipoDAO extends BaseDAO
{
    /**
     * @var string
     */
    private $nombreTabla = "equipo";

    /**
     * EquipoDAO constructor.
     */
    public function __construct()
    {
        parent::__construct($this->nombreTabla);
    }

    /**
     * Function add
     * @param object $equipo
     * @return mixed|void
     */
    public function add(object $equipo)
    {
        $pdo = $this->conexion->prepare('INSERT INTO `equipo`( `nombre`) VALUES (?)');
        $pdo->execute(
            array(
                $equipo->getNombre(),
            )
        );
    }

    /**
     * Function edit
     * @param $id
     * @param object $equipo
     * @return mixed|void
     */
    public function edit($id, object $equipo)
    {
        $pdo = $this->conexion->prepare('UPDATE `equipo` set `nombre`=? where idEquipo=?');
        $pdo->execute(
            array(
                $equipo->getNombre(),
                $id
            )
        );
    }

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
    public function view($id)
    {
        return parent::view($id);
    }

    /**
     * Function list
     * @return array|null
     */
    public function list()
    {
        return parent::list();
    }

    /**
     * Function getJugadores
     * @param $id
     * @return array|null
     */
    public function getJugadores($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT jugador.idJugador, persona.nombre, persona.primerApellido, persona.segundoApellido FROM $this->nombreTabla INNER JOIN jugador on jugador.idEquipo = equipo.idEquipo LEFT JOIN persona on jugador.idJugador = persona.idPersona WHERE equipo.idEquipo=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, "Jugador");
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function deleteJugador
     * @param $id
     */
    public function deleteJugador($id)
    {
        try {
            $stm = $this->conexion->prepare("UPDATE jugador set idEquipo=null where idJugador=?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function deleteJugadorSetDispo
     * @param $id
     */
    public function deleteJugadorSetDispo($id)
    {
        try {
            $stm = $this->conexion->prepare("UPDATE jugador set idEquipo=null, estado='disponible' where idJugador=?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getIdEquipo
     * @param $nombreEquipo
     * @return mixed|string
     */
    public function getIdEquipo($nombreEquipo)
    {
        try {
            $result = "";
            $stm = $this->conexion->prepare("SELECT `idEquipo` FROM `equipo` WHERE `nombre`=?");
            $stm->execute(array($nombreEquipo));
            if ($stm->rowCount() != 0) {
                $arrayEquipo = $stm->fetch(PDO::FETCH_ASSOC);
                $result = $arrayEquipo["idEquipo"];
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function getNombresEquipos
     * @return array
     */
    public function getNombresEquipos()
    {
        try {
            $result = array();
            $stm = $this->conexion->prepare("select equipo.nombre from equipo");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}