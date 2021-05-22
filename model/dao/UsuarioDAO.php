<?php

include_once 'BaseDAO.php';
include_once "../model/entity/Usuario.php";
include_once('../utility/CodigosError.php');

class UsuarioDAO extends BaseDAO
{

    private $nombreTabla = "usuario";

    function getNombreTabla()
    {
        return $this->nombreTabla;
    }

    public function __construct()
    {
        parent::__construct($this->nombreTabla);
    }

    public function add(object $objeto)
    {

    }

    public function edit(object $objeto)
    {

    }

    public function view($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM $this->nombreTabla left join persona on persona.idPersona = usuario.idUsuario WHERE usuario.idUsuario=1");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function list()
    {
        return parent::list();
    }

    public function createSesionUsuario($usuario)
    {
        try {
            $pdo = $this->conexion->prepare("SELECT idUsuario, nombreUsuario, rol FROM `usuario` where nombreUsuario=? or correoElectronico=?");
            $pdo->execute(array($usuario, $usuario));
            $data = $pdo->fetch(PDO::FETCH_ASSOC);
            $_SESSION["idUsuario"] = $data["idUsuario"];
            $_SESSION["usuario"] = $data["nombreUsuario"];
            $_SESSION["rol"] = $data["rol"];
            return $data;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function login($usuario, $rol)
    {
        try {
            $pdo = $this->conexion->prepare("SELECT nombreUsuario, contraseña, rol FROM `usuario` where nombreUsuario=? or correoElectronico=? and rol =?");
            $pdo->execute(array($usuario, $usuario, $rol));
            $data = $pdo->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function validarUsuario($usuario, $pass, $rol)
    {
        if ($usuario == null) {
            return CodigosError::usuario_empty;
        } else if ($pass == null) {
            return CodigosError::pass_empty;
        } else {
            $data = $this->login($usuario, $rol);
            if ($data != false) {
                if ($data['contraseña'] == md5($pass)) {
                    $errorNoExiste = false;
                    return 0;
                }
            }
            return CodigosError::user_not_exists;
        }
    }

    public function delete($id)
    {
        parent::delete($id);
    }

}
