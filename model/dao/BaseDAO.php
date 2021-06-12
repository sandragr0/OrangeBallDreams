<?php

/**
 * Class BaseDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
abstract class BaseDAO implements InterfaceDAO
{

    /**
     * @var
     */
    private $nombreTabla;
    /**
     * @var \PDO
     */
    protected $conexion;

    /**
     * BaseDAO constructor.
     * @param $nombreTabla
     */
    function __construct($nombreTabla)
    {
        $this->nombreTabla = $nombreTabla;
        $this->conexion = Database::connect();
    }

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
    function view($id)
    {
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

    /**
     * Function list
     * @return array|null
     */
    function list()
    {
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

    /**
     * Function edit
     * @param $id
     * @param object $objeto
     * @return mixed
     */
    abstract function edit($id, object $objeto);

    /**
     * Function add
     * @param object $objeto
     * @return mixed
     */
    abstract function add(object $objeto);

    /**
     * Function delete
     * @param object $id
     */
    function delete($id)
    {
        try {
            $stm = $this->conexion->prepare("DELETE FROM $this->nombreTabla where id$this->nombreTabla = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
