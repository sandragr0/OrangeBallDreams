<?php

include_once('AdminController.php');
include_once('../model/dao/UsuarioDAO.php');

class AdminControllerUsuario extends AdminController {

    private $model;
    private $controllerName = "Usuario";

    public function __construct() {
        $this->model = new UsuarioDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function login() {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-view/login-admin.php';
        } else {
            $usuario = isset($_POST['user']) ? Utilidades::cleanString($_POST['user']) : null;
            $pass = isset($_POST['password']) ? Utilidades::cleanString($_POST['password']) : null;
            $estadoErrores = $this->model->validarUsuario($usuario, $pass, "administrador");
            if ($estadoErrores == 0) {
                session_start();
                $this->model->createSesionUsuario($usuario);
                header('Location: admin.php?c=jugador&a=list');
            } else {
                include_once '../view/admin/admin-view/login-admin.php';
            }
        }
    }

    public function exit() {
        $_SESSION['usuario'] = null;
        session_destroy();
        include_once '../view/admin/admin-view/login-admin.php';
    }

    public function add() {
        parent::add();
    }

    public function edit() {
        parent::edit();
    }

    public function insert(object $object) {
        parent::insert($object);
    }

    public function list() {
        parent::list();
    }

    public function view() {
        parent::view();
    }

}
