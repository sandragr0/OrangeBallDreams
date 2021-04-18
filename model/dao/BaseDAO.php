<?php
include_once '../DB/Database.php';
abstract class BaseDAO {
    
    private $nombreTabla;
    protected $conexion;
    
    function __construct($nombreTabla) {
        $this->nombreTabla = $nombreTabla;
        $this->conexion = Database::connect();
    }
    
    function getAll() {
        $this->conexion->prepare('SELECT * FROM ' . $this->nombreTabla);
    }
    
    abstract function update(object $objeto);
    
    abstract function insert(object $objeto);
    
    
    
    
    
}