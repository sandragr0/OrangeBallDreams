<?php

include_once 'BaseDAO.php';
include_once "../model/entity/Usuario.php";

class UsuarioDAO extends BaseDAO {

    private $nombreTabla = "usuario";

    function getNombreTabla() {
        return $this->nombreTabla;
    }

    public function __construct() {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $objeto) {
        
    }

    public function edit(object $objeto) {
        
    }

    public function view($id) {
        return parent::view();
    }

    public function list() {
        return parent::list();
    }

    public function login($usuario) {
        try {
            $pdo = $this->conexion->prepare("SELECT nombre, contraseña, rol FROM `usuario` where usuario=? and rol =?");
            $pdo->execute(array($usuario, "administrador"));
            $data = $pdo->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function validarUsuario($usuario, $pass) {
        if ($usuario == null) {
            return -1;
        } else if ($pass == null) {
            return -2;
        } else {
            $data = $this->login($usuario);
            if ($data != false) {
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

}
