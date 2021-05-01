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

    // -------------------- User login and logout --------------------
    // Devuelve 0 si todo ok, -1 si hay error de usuario, -2 si hay error de password, -3 si no existe el usuario
    public function validarUsuario($usuario, $pass) {
        if ($usuario == null) {
            return -1;
        } else if ($pass == null) {
            return -2;
        } else {
            include_once '../DB/Database.php';
            $conexion = Database::connect();
            $pdo = $conexion->prepare("SELECT usuario.nombre, usuario.contraseña, rol.nombre as rol FROM `usuario` left JOIN usuarios_roles on usuarios_roles.idUsuario=usuario.idUsuario left join rol on rol.idRol = usuarios_roles.idRol where usuario.usuario=? and rol.nombre =?");
            $pdo->execute(array($usuario, "administrador"));
            $data = $pdo->fetch(PDO::FETCH_ASSOC);

            if ($pdo->rowCount() != 0) {
                if ($data['contraseña'] == md5($pass)) {
                    $errorNoExiste = false;
                    return 0;
                } else {
                    return -3;
                }
            } else {
                return -3;
            }
        }
    }

    public function login() {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/login-admin.php';
        } else {
            $usuario = isset($_POST['user']) ? $_POST['user'] : null;
            $pass = isset($_POST['password']) ? $_POST['password'] : null;
            $estadoErrores = $this->validarUsuario($usuario, $pass);
            if ($estadoErrores == 0) {
                session_start();
                $_SESSION["usuario"] = $usuario;
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

    // -------------------- For multiple controllers --------------------

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
            $jugador = $this->model->view($_REQUEST['id']);
        }
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/view" . $this->controller . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $jugador = $this->model->view($_REQUEST['id']);
        }
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/edit" . $this->controller . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

}
