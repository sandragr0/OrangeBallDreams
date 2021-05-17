<?php

require_once('../utility/Utilidades.php');
include_once 'BaseDAO.php';
include_once "../model/entity/Jugador.php";

class JugadorDAO extends BaseDAO {

    private $nombreTabla = "jugador";

    public function __construct() {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $jugador) {
        print_r($jugador);
        try {
            $pdo = $this->conexion->prepare('INSERT INTO `persona`( `dni`, `nombre`, `primerApellido`, `segundoApellido`, `telefono`) VALUES (?,?,?,?,?)');

            $pdo->execute(
                    array(
                        $jugador->getDni(),
                        $jugador->getNombre(),
                        $jugador->getPrimerApellido(),
                        $jugador->getSegundoApellido(),
                        $jugador->getTelefono()
                    )
            );

            $idJugador = $this->conexion->lastInsertId();

            $pdo = $this->conexion->prepare('INSERT INTO `jugador`(`idJugador`, `genero`, `altura`, `extracomunitario`, `fechaNacimiento`, `estado`, `posicion`, `biografia`, `informe`, `visible`) VALUES (?,?,?,?,?,?,?,?,?,?)');

            $pdo->execute(
                    array(
                        $idJugador,
                        $jugador->getGenero(),
                        $jugador->getAltura(),
                        $jugador->getExtracomunitario(),
                        $jugador->getFechaNacimiento(),
                        $jugador->getEstado(),
                        $jugador->getPosicion(),
                        $jugador->getBiografia(),
                        $jugador->getInforme(),
                        $jugador->getVisible()
                    )
            );

            $pdo = $this->conexion->prepare("INSERT INTO `imagen`(`ruta`,`idJugador`) VALUES(?,?)");

            $pdo->execute(
                    array(
                        $jugador->getRuta(),
                        $idJugador
                    )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function edit(object $objeto) {
        return null;
    }

    function view($id) {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT jugador.idJugador, dni, persona.nombre, primerApellido, segundoApellido, telefono, altura, extracomunitario, fechaNacimiento, telefono, estado, posicion, biografia, informe, visible, jugador.idEquipo, equipo.nombre as equipo, ruta FROM $this->nombreTabla INNER JOIN persona on persona.idPersona = jugador.idJugador LEFT JOIN equipo on equipo.idEquipo = jugador.idEquipo LEFT JOIN imagen on jugador.idJugador = imagen.idJugador where jugador.idJugador=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function list() {
        try {
            $result = null;

            $stm = $this->conexion->prepare("SELECT idJugador, dni, persona.nombre, primerApellido, segundoApellido, telefono, altura, extracomunitario, fechaNacimiento, telefono, estado, posicion, biografia, informe, visible, jugador.idEquipo, equipo.nombre as equipo FROM $this->nombreTabla INNER JOIN persona on persona.idPersona = jugador.idJugador LEFT JOIN equipo on equipo.idEquipo = jugador.idEquipo");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id) {
        parent::delete($id);
    }

}
