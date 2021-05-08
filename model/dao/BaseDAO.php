<?php

include_once '../DB/Database.php';
include_once '../model/entity/Jugador.php';

abstract class BaseDAO {

    private $nombreTabla;
    protected $conexion;

    function __construct($nombreTabla) {
        $this->nombreTabla = $nombreTabla;
        $this->conexion = Database::connect();
    }

    function list() {
        try {
            $result = array();

            $stm = $this->conexion->prepare("SELECT * FROM $this->nombreTabla");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function view($id) {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM $this->nombreTabla WHERE id$this->nombreTabla = ?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function exists($id) {
        try {
            $result = false;
            $stm = $this->conexion->prepare("SELECT * FROM $this->nombreTabla WHERE id$this->nombreTabla = ?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = true;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    abstract function edit(object $objeto);

    abstract function add(object $objeto);
}
