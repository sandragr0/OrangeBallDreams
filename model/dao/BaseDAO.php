<?php
abstract class BaseDAO {

    private $nombreTabla;
    protected $conexion;

    function __construct($nombreTabla) {
        $this->nombreTabla = $nombreTabla;
        $this->conexion = Database::connect();
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

    function list() {
        try {
            $result = null;

            $stm = $this->conexion->prepare("SELECT * FROM $this->nombreTabla");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    function delete($id) {
        try {
            $stm = $this->conexion->prepare("DELETE FROM $this->nombreTabla where id$this->nombreTabla = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    abstract function edit($id, object $objeto);

    abstract function add(object $objeto);
}
