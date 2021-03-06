<?php


/**
 * Class AdminControllerJugador
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class AdminControllerJugador extends AdminController
{
    /**
     * @var \JugadorDAO
     */
    private $model;

    /**
     * @var \EquipoDAO
     */
    private $modelEquipo;

    /**
     * @var string
     */
    private $controllerName = "Jugador";

    /**
     * AdminControllerJugador constructor.
     */
    public function __construct()
    {
        $this->modelEquipo = new EquipoDAO();
        $this->model = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    /**
     * Function add
     * @return void
     */
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

    /**
     * Function edit
     * @return void
     */
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

    /**
     * Function delete
     */
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

            // Redirigir a la p??gina actual
            header('Location:' . $_SERVER["PHP_SELF"]);
        }
    }

    /**
     * Function validarDatos
     * @param $datos
     * @param $archivos
     * @return int
     */
    private function validarDatos($datos, $archivos): int
    {
        if ($datos["nombre"] != "") {
            if (!Utilidades::isStringWithWhiteSpaces($datos["nombre"])) {
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

        if ($datos["fechaNac"] != "") {
            if (!Utilidades::isFecha($datos["fechaNac"])) {
                return CodigosError::fechaNac_invalid;
            }
        } else {
            return CodigosError::fechaNac_empty;
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
        } else {
            return CodigosError::altura_empty;
        }


        if ($datos["equipo"] != "") {
            if (!Utilidades::isAlpha($datos["equipo"])) {
                return CodigosError::equipo_invalid;
            }
        }

        return 0;
    }


    /**
     * Function createJugador
     * @param $datos
     * @param $archivos
     * @return \Jugador
     */
    private function createJugador($datos, $archivos): Jugador
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
            $nombreImagen = preg_replace('/[[:space:]]+/', '-', $nombreImagen);
            $ext = pathinfo($archivos["imagen"]["name"], PATHINFO_EXTENSION);

            $isImagenSubida = $this->guardarImagen($archivos, $nombreImagen, $ext);
            if ($isImagenSubida) {
                $ruta = "/assets/img/jugador/uploads/" . $nombreImagen . "." . "$ext";
            } else {
                $ruta = "/assets/img/jugador/default/imagen-default.jpg";
            }
            $jugador->setRuta($ruta);
        }
        return $jugador;
    }

    /**
     * Function guardarImagen
     * @param $archivos
     * @param $nombreImagen
     * @param $ext
     * @return bool
     */
    private function guardarImagen($archivos, $nombreImagen, $ext): bool
    {
        return move_uploaded_file($archivos["imagen"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/assets/img/jugador/uploads/" . $nombreImagen . "." . $ext);
    }
}
