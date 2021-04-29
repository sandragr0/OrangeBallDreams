<?php

require_once('../model/dao/JugadorDAO.php');
require_once('../model/dao/UsuarioDAO.php');
require_once('../model/dao/EquipoDAO.php');

class AdminController {

    private $model;
    private $controller;

    public function __construct($controller = null) {
        if ($controller != null) {
        $this->controller = $controller;
        $dao = $controller . "DAO";
        $this->model = new $dao();
        }
    }
    
    // User login and logout
    public function exit() {
        $_SESSION['usuario'] = null;
        session_destroy();
        include_once '../view/admin/login-admin.php';
    }
    public function login() {
        include_once '../view/admin/login-admin.php';
    }
    
    // For multiple controllers

    public function list() {
        $this->model->list();
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/list".$this->controller.".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function insert(object $object) {
        $this->model->insert($object);
    }
    
    public function add() {
      //  $this->model->insert($object);
        include_once '../view/admin/admin-panel-header.php';
         include_once "../view/admin/admin-view/add".$this->controller.".php";
    }
    
    public function view() {
      $jugador = new $this->controller();

        if (isset($_REQUEST['id'])) {
            $jugador = $this->model->view($_REQUEST['id']);  
        }
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/view".$this->controller.".php";
    }

}
