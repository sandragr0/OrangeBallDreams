<?php

include_once 'BaseDAO.php';
include_once "../model/entity/Usuario.php";

class UsuarioDAO extends BaseDAO {
     private $nombreTabla = "usuario";
     
     public function __construct() {
         parent::__construct($this->nombreTabla);
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


