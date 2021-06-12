<?php

/**
 * Class UsuarioDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
 */
class UsuarioDAO extends BaseDAO
{

    /**
     * @var string
     */
    private $nombreTabla = "usuario";

    /**
     * Function getNombreTabla
     * @return string
     */
    function getNombreTabla()
    {
        return $this->nombreTabla;
    }

    /**
     * UsuarioDAO constructor.
     */
    public function __construct()
    {
        parent::__construct($this->nombreTabla);
    }

    /**
     * Function add
     * @param object $usuario
     * @return mixed|void
     */
    public function add(object $usuario)
    {
        // Añadir persona
        $pdo = $this->conexion->prepare('INSERT INTO `persona`( `dni`, `nombre`, `primerApellido`, `segundoApellido`, `telefono`) VALUES (?,?,?,?,?)');

        $pdo->execute(
            array(
                $usuario->getDni(),
                $usuario->getNombre(),
                $usuario->getPrimerApellido(),
                $usuario->getSegundoApellido(),
                $usuario->getTelefono()
            )
        );

        $idUsuario = $this->conexion->lastInsertId();

        // Añadir jugador
        $pdo = $this->conexion->prepare('INSERT INTO `usuario`(`idUsuario`,`correoElectronico`, `contraseña`, `nombreUsuario`, `rol`) VALUES (?,?,?,?,?);');
        $pdo->execute(
            array(
                $idUsuario,
                $usuario->getCorreoElectronico(),
                $usuario->getContraseña(),
                $usuario->getNombreUsuario(),
                $usuario->getRol()
            )
        );
    }

    /**
     * Function edit
     * @param $id
     * @param object $usuario
     * @return mixed|void
     */
    public function edit($id, object $usuario)
    {
        // Editar persona
        $pdo = $this->conexion->prepare('UPDATE `persona` set  `dni`=?, `nombre`=?, `primerApellido`=?, `segundoApellido`=?, `telefono`=? where idPersona=?;');

        $pdo->execute(
            array(
                $usuario->getDni(),
                $usuario->getNombre(),
                $usuario->getPrimerApellido(),
                $usuario->getSegundoApellido(),
                $usuario->getTelefono(),
                $id
            )
        );
    }

    /**
     * Function view
     * @param $id
     * @return mixed|null
     */
    public function view($id)
    {
        try {
            $result = null;
            $stm = $this->conexion->prepare("SELECT * FROM `viewusuarios` WHERE idUsuario=?");
            $stm->execute(array($id));
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchObject($this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function list
     * @return array|null
     */
    public function list()
    {
        try {
            $result = null;

            $stm = $this->conexion->prepare("SELECT * FROM `viewusuarios`");
            $stm->execute();
            if ($stm->rowCount() != 0) {
                $result = $stm->fetchAll(PDO::FETCH_CLASS, $this->nombreTabla);
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function createSesionUsuario
     * @param $usuario
     * @return mixed
     */
    public function createSesionUsuario($usuario)
    {
        try {
            $pdo = $this->conexion->prepare("SELECT idUsuario, nombreUsuario, rol FROM `usuario` where nombreUsuario=? or correoElectronico=?");
            $pdo->execute(array($usuario, $usuario));
            $data = $pdo->fetch(PDO::FETCH_ASSOC);
            $_SESSION["idUsuario"] = $data["idUsuario"];
            $_SESSION["usuario"] = $data["nombreUsuario"];
            $_SESSION["rol"] = $data["rol"];
            // Actualizar fecha acceso
            $pdo = $this->conexion->prepare("UPDATE usuario set fechaAcceso=? where idUsuario=?");
            $pdo->execute(array(date("Y-m-d"), $data["idUsuario"]));
            return $data;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Function login
     * @param $usuario
     * @param $rol
     * @return mixed
     */
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

    /**
     * Function validarUsuario
     * @param $usuario
     * @param $pass
     * @param $rol
     * @return int
     */
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

    /**
     * Function delete
     * @param object $id
     * @return mixed|void
     */
    public function delete($id)
    {
        parent::delete($id);
    }

}
