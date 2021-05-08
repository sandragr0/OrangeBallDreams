<?php

include_once 'BaseDAO.php';
include_once "../model/entity/Jugador.php";

class JugadorDAO extends BaseDAO {

    private $nombreTabla = "jugador";

    public function __construct() {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $jugador) {
        $this->conexion->prepare('INSERT INTO `jugador`(`nombre`, `primerApellido`, `segundoApellido`, `altura`, `extracomunitario`, `fechaNacimiento`, `telefono`, `estado`, `biografia`, `informe`, `idEquipo`, `posicion`) VALUES (?,?,?,?,?,?,?,?,?,?,?)');

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
                    $jugador->getIdEquipo(),
                    $jugador->getPosicion()
                )
        );
    }

    public function edit(object $objeto) {
        return null;
    }

    public function view($id) {
        return parent::view($id);
    }

    public function list() {
        return parent::list();
    }

}
