<?php
class EquipoDAO extends BaseDAO {
    private $nombreTabla = "equipo";

    public function __construct() {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $equipo) {
        $pdo = $this->conexion->prepare('INSERT INTO `equipo`( `nombre`) VALUES (?)');
        $pdo->execute(
            array(
                $equipo->getNombre(),
            )
        );
    }

    public function edit($id, object $equipo)
    {
        $pdo = $this->conexion->prepare('UPDATE `equipo` set `nombre`=?');
        $pdo->execute(
            array(
                $equipo->getNombre(),
            )
        );
    }

    public function view($id) {
      return parent::view($id);
    }

    public function list() {
        return parent::list();
    }

    public function getJugadores($id) {
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

    public function deleteJugador($id) {
        try {
            $stm = $this->conexion->prepare("UPDATE jugador set idEquipo=null where idJugador=?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteJugadorSetDispo($id) {
        try {
            $stm = $this->conexion->prepare("UPDATE jugador set idEquipo=null, estado='disponible' where idJugador=?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

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
            echo $result;
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}