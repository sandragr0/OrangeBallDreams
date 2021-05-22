<?php

require_once('AdminController.php');
require_once('../model/dao/JugadorDAO.php');

/**
 * Class AdminControllerJugador
 */
class AdminControllerJugador extends AdminController
{

    /**
     * @var JugadorDAO
     */
    private $model;
    private $controllerName = "Jugador";

    /**
     * AdminControllerJugador constructor.
     */
    public function __construct()
    {
        $this->model = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function add()
    {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $error = $this->validarDatos($_POST, $_FILES);
            if ($error == 0) {
                $jugador = $this->createJugador($_POST, $_FILES);
                $this->model->add($jugador);
                header('Location: admin.php?c=jugador&a=list');
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }

    public function edit()
    {
        parent::edit();
    }

    public function insert(object $object)
    {
        parent::insert($object);
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
            if ($arrayImagen["ruta"] != "/assets/img/jugador/imagen-default.jpg") {
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
        $jugador = new Jugador();
        // Limpiar datos y mapearlos
        $jugador->setNombre(Utilidades::mb_ucfirst(Utilidades::cleanString($datos["nombre"])));
        $jugador->setPrimerApellido(Utilidades::mb_ucfirst(Utilidades::cleanString($datos["apellido1"])));
        $jugador->setSegundoApellido(Utilidades::mb_ucfirst(Utilidades::cleanString($datos["apellido2"])));
        $jugador->setDni(mb_strtoupper(Utilidades::cleanString($datos["dni"])));
        $jugador->setGenero($datos["genero"]);
        $datos["fechaNac"] == "" ? $jugador->setFechaNacimiento(null) : $jugador->setFechaNacimiento($datos["fechaNac"]);
        $datos["telefono"] == "" ? $jugador->setTelefono(null) : $jugador->setTelefono($datos["telefono"]);
        $jugador->setVisible($datos["visibilidad"]);
        $datos["altura"] == "" ? $jugador->setAltura(null) : $jugador->setAltura($datos["altura"]);
        $jugador->setPosicion($datos["posicion"]);
        $jugador->setExtracomunitario($datos["extracomunitario"]);
        $jugador->setEstado($datos["estado"]);
        $jugador->setEquipo(mb_strtoupper(Utilidades::cleanString($datos["equipo"])));
        $jugador->setBiografia(Utilidades::mb_ucfirst(Utilidades::cleanString($datos["biografia"])));
        $jugador->setInforme(Utilidades::mb_ucfirst(Utilidades::cleanString($datos["informe"])));

        // Variables para subir la imagen
        $nombreImagen = $datos["nombre"] . "-" . $datos["apellido1"];
        $extension = pathinfo($archivos["imagen"]["name"], PATHINFO_EXTENSION);


        $isImagenSubida = $this->guardarImagen($archivos, $nombreImagen, $extension);
        if ($isImagenSubida) {
            $ruta = "/assets/img/jugador/uploads/" . $nombreImagen . "." . "$extension";
            $jugador->setRuta($ruta);
        } else {
            $ruta = "/assets/img/jugador/default/imagen-default.jpg";
            $jugador->setRuta($ruta);
        }
        return $jugador;
    }

    private function guardarImagen($archivos, $nombreImagen, $ext)
    {
        $resultado = move_uploaded_file($archivos["imagen"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams/assets/img/jugador/uploads/" . $nombreImagen . "." . $ext);
        return $resultado;
    }

}
