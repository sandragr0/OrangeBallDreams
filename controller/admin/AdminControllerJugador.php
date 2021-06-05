<?php

class AdminControllerJugador extends AdminController
{

    private $model;
    private $modelEquipo;
    private $controllerName = "Jugador";

    public function __construct()
    {
        $this->modelEquipo = new EquipoDAO();
        $this->model = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function add()
    {
        $nacionalidades = $this->model->listNacionalidades();
        $listadoNombresEquipos = $this->modelEquipo->getNombresEquipos();

        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/" . $this->controllerName . "/addJugador.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $error = $this->validarDatos($_POST, $_FILES);
            if ($error == 0) {
                $jugador = $this->createJugador($_POST, $_FILES);
                try {
                    $this->model->add($jugador);
                    header('Location: admin.php?c=jugador&a=list');
                } catch (Exception $e) {
                    Utilidades::logError($e);
                    if ($e->getCode() == 23000) {
                        $db_error = CodigosError::db_duplicate_entry;
                    } else {
                        $db_error = CodigosError::db_generic_error;
                    }
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/addJugador.php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/addJugador.php";
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
            $listadoNombresEquipos = $this->modelEquipo->getNombresEquipos();
            $listadoNacionalidades = $this->model->listNacionalidades();
            if (sizeof($_POST) == 0) {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/editJugador.php";
                include_once '../view/admin/admin-panel-footer.php';
            } else {
                $error = $this->validarDatos($_POST, $_FILES);
                if ($error == 0) {
                    $jugador = $this->createJugador($_POST, $_FILES);
                    try {
                        $this->model->edit($_REQUEST["id"], $jugador);
                        header('Location: admin.php?c=jugador&a=view&id=' . $_GET["id"]);
                    } catch (Exception $e) {
                        Utilidades::logError($e);
                        if ($e->getCode() == 23000) {
                            $db_error = CodigosError::db_duplicate_entry;
                        } else {
                            $db_error = CodigosError::db_generic_error;
                        }
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/" . $this->controllerName . "/editJugador.php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                } else {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/editJugador.php";
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

    public function delete()
    {
        if (isset($_REQUEST['id'])) {
            // Borrar la imagen local del usuario
            $arrayImagen = $this->model->getImage($_REQUEST['id']);
            if ($arrayImagen["ruta"] != "/assets/img/jugador/default/imagen-default.jpg") {
                $ruta = Utilidades::getDocumentRoot() . $arrayImagen["ruta"];
                unlink($ruta);
            }
            // Borrar el jugador
            $this->model->delete($_REQUEST['id']);

            // Redirigir a la página actual
            header('Location:' . $_SERVER["PHP_SELF"]);
        }
    }

    private function validarDatos($datos, $archivos)
    {
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

        if ($datos["fechaNac"] != "") {
            if (!Utilidades::isFecha($datos["fechaNac"])) {
                return CodigosError::fechaNac_invalid;
            }
        }

        if ($datos["telefono"] != "") {
            if (!Utilidades::isTelefono($datos["telefono"])) {
                return CodigosError::telefono_invalid;
            }
        }

        if ($archivos["imagen"]["name"] != "") {
            if (!Utilidades::imgFormatoCorrecto($archivos["imagen"]["type"])) {
                return CodigosError::imagen_wrong_format;
            }
            if (!Utilidades::isValidImgSize($archivos["imagen"]["size"])) {
                return CodigosError::imagen_wrong_size;
            }
        }

        if ($datos["altura"] != "") {
            if (!Utilidades::isAltura($datos["altura"])) {
                return CodigosError::altura_invalid;
            }
        }


        if ($datos["equipo"] != "") {
            if (!Utilidades::isAlpha($datos["equipo"])) {
                return CodigosError::equipo_invalid;
            }
        }

        return 0;
    }

    private function createJugador($datos, $archivos)
    {
        // Limpiar datos y mapearlos
        $jugador = new Jugador();

        $jugador->setNombre(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["nombre"])));
        $jugador->setPrimerApellido(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido1"])));
        $jugador->setSegundoApellido(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido2"])));
        $jugador->setDni(mb_strtoupper(Utilidades::cleanValue($datos["dni"])));
        $jugador->setGenero($datos["genero"]);
        $datos["fechaNac"] == "" ? $jugador->setFechaNacimiento(null) : $jugador->setFechaNacimiento($datos["fechaNac"]);
        $jugador->setTelefono(mb_strtoupper(Utilidades::cleanValue($datos["telefono"])));
        $jugador->setVisible($datos["visibilidad"]);
        $datos["altura"] == "" ? $jugador->setAltura(null) : $jugador->setAltura($datos["altura"]);
        $jugador->setPosicion($datos["posicion"]);
        $jugador->setExtracomunitario($datos["extracomunitario"]);
        $jugador->setEstado($datos["estado"]);
        $jugador->setEquipo(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["equipo"])));
        $jugador->setBiografia(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["biografia"])));
        $jugador->setInforme(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["informe"])));

        // Nacionalidad
        if (isset($datos["nacionalidad"])) {
            $jugador->setNacionalidades($datos["nacionalidad"]);
        } else {
            $jugador->setNacionalidades(null);
        }

        // Imagen del jugador
        if (isset($datos["antiguaRuta"]) && empty($archivos["imagen"]["name"])) {
            $jugador->setRuta($datos["antiguaRuta"]);
        } else {
            $nombreImagen = $datos["nombre"] . "-" . $datos["apellido1"];
            $ext = pathinfo($archivos["imagen"]["name"], PATHINFO_EXTENSION);


            $isImagenSubida = $this->guardarImagen($archivos, $nombreImagen, $ext);
            if ($isImagenSubida) {
                $ruta = "/assets/img/jugador/uploads/" . $nombreImagen . "." . "$ext";
                $jugador->setRuta($ruta);
            } else {
                $ruta = "/assets/img/jugador/default/imagen-default.jpg";
                $jugador->setRuta($ruta);
            }
        }
        return $jugador;
    }

    private function guardarImagen($archivos, $nombreImagen, $ext)
    {
        $resultado = move_uploaded_file($archivos["imagen"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams/assets/img/jugador/uploads/" . $nombreImagen . "." . $ext);
        return $resultado;
    }

}
