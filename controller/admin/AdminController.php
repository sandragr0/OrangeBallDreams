<?php

require_once('../utility/Utilidades.php');
require_once('../model/dao/JugadorDAO.php');
require_once('../model/dao/UsuarioDAO.php');
require_once('../model/dao/EquipoDAO.php');

class AdminController {

    private $model;
    private $controller;

    public function __construct($controller) {
        if ($controller) {
            $this->controller = $controller;
            $dao = $controller . "DAO";
            $this->model = new $dao();
        }
    }

    public function login() {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/login-admin.php';
        } else {
            $usuario = isset($_POST['user']) ? $_POST['user'] : null;
            $pass = isset($_POST['password']) ? $_POST['password'] : null;
            $estadoErrores = $this->model->validarUsuario($usuario, $pass, "administrador");
            if ($estadoErrores == 0) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = "administrador";
                header('Location: admin.php?c=jugador&a=list');
            } else {
                include_once '../view/admin/login-admin.php';
            }
        }
    }

    public function exit() {
        $_SESSION['usuario'] = null;
        session_destroy();
        include_once '../view/admin/login-admin.php';
    }

    public function list() {
        $this->model->list();
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/list" . $this->controller . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function insert(object $object) {
        $this->model->insert($object);
    }

    public function add() {
        //  $this->model->insert($object);
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/add" . $this->controller . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function view() {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = $this->model->view(1);
        }
        include_once '../view/admin/admin-panel-header.php';
        if ($objeto == null) {
            include_once "../view/admin/admin-view/error.php";
        } else {
            include_once "../view/admin/admin-view/view" . $this->controller . ".php";
        }
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = $this->model->view(1);
        }

        include_once '../view/admin/admin-panel-header.php';
        if ($objeto == null) {
            include_once "../view/admin/admin-view/error.php";
        } else {
            include_once "../view/admin/admin-view/edit" . $this->controller . ".php";
        }

        include_once '../view/admin/admin-panel-footer.php';
    }

}
