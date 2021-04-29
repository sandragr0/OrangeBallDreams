<?php
include_once 'BaseDAO.php';
include_once "../model/entity/Equipo.php";

class EquipoDAO extends BaseDAO {
    public function __construct() {
        parent::__construct($nombreTabla);
    }

    public function add(object $objeto) {
        
    }

    public function edit(object $objeto) {
        
    }

    public function view($id) {
        
    }

    public function list() {
        return parent::list();
    }


}