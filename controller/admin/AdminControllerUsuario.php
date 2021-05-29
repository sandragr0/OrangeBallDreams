<?php
class AdminControllerUsuario extends AdminController {

    private $model;
    private $controllerName = "Usuario";

    public function __construct() {
        $this->model = new UsuarioDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function login() {
        if (sizeof($_POST) == 0) {
            include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
        } else {
            $usuario = isset($_POST['user']) ? Utilidades::cleanValue($_POST['user']) : null;
            $pass = isset($_POST['password']) ? Utilidades::cleanValue($_POST['password']) : null;
            $estadoErrores = $this->model->validarUsuario($usuario, $pass, "administrador");
            if ($estadoErrores == 0) {
                session_start();
                $this->model->createSesionUsuario($usuario);
                header('Location: admin.php?c=jugador&a=list');
            } else {
                include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
            }
        }
    }

    public function exit() {
        $_SESSION['usuario'] = null;
        session_destroy();
        include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
    }

    public function add() {

    }

    public function edit() {

    }

    public function list() {
        parent::list();
    }

    public function view() {
        parent::view();
    }

}
