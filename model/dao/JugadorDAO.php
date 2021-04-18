<?php

include_once 'BaseDAO.php';
include_once '../entity/Jugador.php';

class JugadorDAO extends BaseDAO {

    private $conexion = parent::conexion;

    public function __construct($nombreTabla) {
        parent::__construct($nombreTabla);
    }

    public function insert(Jugador $jugador) {

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

    public function update(Jugador $jugador) {
        return null;
    }

    public function getAll() {
        parent::getAll();
    }

}
