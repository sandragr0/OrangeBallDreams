<?php

include_once 'BaseDAO.php';
include_once "../model/entity/Jugador.php";

class JugadorDAO extends BaseDAO {

    private $nombreTabla = "jugador";

    public function __construct() {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $jugador) {
        $this->conexion->prepare('INSERT INTO `jugador`(`nombre`, `primerApellido`, `segundoApellido`, `altura`, `extracomunitario`, `fechaNacimiento`, `telefono`, `estado`, `biografia`, `informe`, `idEquipo`) VALUES (?,?,?,?,?,?,?,?,?,?,?)');

        $this->pdo->prepare($sql)->execute(
                array(
                    $jugador->getNombre(),
                    $jugador->getPrimerApellido(),
                    $jugador->getSegundoApellido(),
                    $jugador->getAltura(),
                    $jugador->getExtracomunitario(),
                    $jugador->getFechaNac(),
                    $jugador->getTelefono(),
                    $jugador->getEstado(),
                    $jugador->getBiografia(),
                    $jugador->getInforme(),
                    $jugador->getIdEquipo()
                )
        );
    }

    public function edit(object $objeto) {
        return null;
    }

    public function view($id) {
        try {
            $stm = $this->conexion->prepare("SELECT idJugador, jugador.nombre, primerApellido, segundoApellido, altura, extracomunitario, fechaNacimiento, telefono, estado, biografia, informe, jugador.idEquipo, equipo.nombre as nombreEquipo FROM $this->nombreTabla LEFT JOIN equipo ON equipo.idEquipo = jugador.idEquipo WHERE id$this->nombreTabla = ?");
            $stm->execute(array($id));
            return $stm->fetchObject($this->nombreTabla);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function list() {
        return parent::list();
    }

}
