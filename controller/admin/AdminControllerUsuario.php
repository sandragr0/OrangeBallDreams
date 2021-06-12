<?php

class AdminControllerUsuario extends AdminController
{

    private $model;
    private $controllerName = "Usuario";

    public function __construct()
    {
        $this->model = new UsuarioDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function login()
    {
        if (sizeof($_POST) == 0) {
            include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
        } else {
            $usuario = isset($_POST['user']) ? Utilidades::cleanValue($_POST['user']) : null;
            $pass = isset($_POST['password']) ? Utilidades::cleanValue($_POST['password']) : null;
            $estadoErrores = $this->model->validarUsuario($usuario, $pass, "administrador");
            if ($estadoErrores == 0) {
                session_start();
                $this->model->createSesionUsuario($usuario);
                if (isset($_POST["recordar"])) {
                    $tiempoCookie = time() + 7 * 24 * 60 * 60;
                    setcookie("UsuarioRecordar", $usuario, $tiempoCookie);
                }
                header('Location: admin.php?c=jugador&a=list');
            } else {
                include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
            }
        }
    }

    public function exit()
    {
        $_SESSION['usuario'] = null;
        session_destroy();
        include_once "../view/admin/admin-view/" . $this->controllerName . "/login-admin.php";
    }

    public function add()
    {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/" . $this->controllerName . "/addUsuario.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $error = $this->validarDatos($_POST);
            if ($error == 0) {
                $usuario = $this->createUsuario($_POST);
                try {
                    $this->model->add($usuario);
                    header('Location: admin.php?c=usuario&a=list');
                } catch (Exception $e) {
                    Utilidades::logError($e);
                    if ($e->getCode() == 23000) {
                        $db_error = CodigosError::db_duplicate_entry;
                    } else {
                        $db_error = CodigosError::db_generic_error;
                    }
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/addUsuario.php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/addUsuario.php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }

    public function edit()
    {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = null;
        }

        if ($objeto == null) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/error.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            if (sizeof($_POST) == 0) {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/editUsuario.php";
                include_once '../view/admin/admin-panel-footer.php';
            } else {
                $error = $this->validarDatos($_POST);
                if ($error == 0) {
                    $usuario = $this->createUsuario($_POST);
                    try {
                        $this->model->edit($_REQUEST['id'], $usuario);
                        header('Location: admin.php?c=usuario&a=list');
                    } catch (Exception $e) {
                        Utilidades::logError($e);
                        if ($e->getCode() == 23000) {
                            $db_error = CodigosError::db_duplicate_entry;
                        } else {
                            $db_error = CodigosError::db_generic_error;
                        }
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/" . $this->controllerName . "/editUsuario.php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                } else {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/editUsuario.php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            }
        }
    }

    public function list()
    {
        parent::list();
    }

    public function view()
    {
        parent::view();
    }

    private function validarDatos($datos)
    {
        // Nombre de usuario
        if ($datos["nombreUsuario"] != "") {
            if (!Utilidades::isValidUsuario($datos["nombreUsuario"])) {
                return CodigosError::usuario_invalid;
            }
        } else {
            return CodigosError::usuario_empty;
        }

        // Email
        if ($datos["correoElectronico"] != "") {
            if (!Utilidades::isCorreoElectronico($datos["correoElectronico"])) {
                return CodigosError::correo_electronico_invalid;
            }
        } else {
            return CodigosError::correo_electronico_empty;
        }

        // Contraseña
        if (!isset($datos["modoEdicion"])) {
            if ($datos["contraseña"] != "") {
                if (!Utilidades::isValidPassword($datos["contraseña"])) {
                    return CodigosError::pass_invalid;
                }
            } else {
                return CodigosError::pass_empty;
            }
        }

        if ($datos["nombre"] != "") {
            if (!Utilidades::isString($datos["nombre"])) {
                return CodigosError::nombre_invalid;
            }
        } else {
            return CodigosError::nombre_empty;
        }

        if ($datos["apellido1"] != "") {
            if (!Utilidades::isString($datos["apellido1"])) {
                return CodigosError::apellido1_invalid;
            }
        } else {
            return CodigosError::apellido1_empty;
        }


        if ($datos["apellido2"] != "") {
            if (!Utilidades::isString($datos["apellido2"])) {
                return CodigosError::apellido2_invalid;
            }
        }

        if ($datos["dni"] != "") {
            if (!Utilidades::isDNI($datos["dni"])) {
                return CodigosError::dni_invalid;
            }
        }

        if ($datos["telefono"] != "") {
            if (!Utilidades::isTelefono($datos["telefono"])) {
                return CodigosError::telefono_invalid;
            }
        }

        return 0;
    }

    private function createUsuario($datos)
    {
        // Limpiar datos y mapearlos
        $usuario = new Usuario();
        $usuario->setNombreUsuario(Utilidades::cleanValue($datos["nombreUsuario"]));
        $usuario->setCorreoElectronico(Utilidades::cleanValue($datos["correoElectronico"]));
        $usuario->setContraseña(md5(Utilidades::cleanValue($datos["contraseña"])));
        $usuario->setRol($datos["rol"]);
        $usuario->setNombre((Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["nombre"]))));
        $usuario->setPrimerApellido(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido1"])));
        $usuario->setSegundoApellido((Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido2"]))));
        $usuario->setDni(Utilidades::cleanValue($datos["dni"]));
        $usuario->setTelefono(Utilidades::cleanValue($datos["telefono"]));

        return $usuario;
    }

}
