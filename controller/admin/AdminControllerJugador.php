<?php

require_once('AdminController.php');
require_once('../model/dao/JugadorDAO.php');

class AdminControllerJugador extends AdminController {

    private $model;
    private $controllerName = "Jugador";

    public function __construct() {
        $this->model = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function add() {
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

    public function delete() {
        if (isset($_REQUEST['id'])) {
            // Borrar la imagen local del usuario
            $arrayImagen = $this->model->getImage($_REQUEST['id']);
            if ($arrayImagen["ruta"] != "/assets/img/jugador/imagen-default.jpg") {
                $ruta = Utilidades::getDocumentRoot() . $arrayImagen["ruta"];
                unlink($ruta);
            }
            // Borrar el jugador
            $objeto = $this->model->delete($_REQUEST['id']);

            // Redirigir a la página actual
            header('Location:' . $_SERVER["PHP_SELF"]);
        }
    }

    private function validarDatos($datos, $archivos) {
        if ($datos["nombre"] != "") {
            if (!Utilidades::isString($datos["nombre"])) {
                return 1;
            }
        } else {
            return 2;
        }

        if ($datos["apellido1"] != "") {
            if (!Utilidades::isString($datos["apellido1"])) {
                return 3;
            }
        } else {
            return 4;
        }


        if ($datos["apellido2"] != "") {
            if (!Utilidades::isString($datos["apellido2"])) {
                return 5;
            }
        }


        if ($datos["fechaNac"] != "") {
            if (!Utilidades::isFecha($datos["fechaNac"])) {
                return 6;
            }
        }

        if ($datos["telefono"] != "") {
            if (!Utilidades::isTelefono($datos["telefono"])) {
                return 7;
            }
        }

        if ($datos["altura"] != "") {
            if (!Utilidades::isAltura($datos["altura"])) {
                return 8;
            }
        }

        if ($datos["dni"] != "") {
            if (!Utilidades::isDNI($datos["dni"])) {
                return 10;
            }
        }

        if ($datos["equipo"] != "") {
            if (!Utilidades::isAlpha($datos["equipo"])) {
                return 9;
            }
        }

        if ($archivos["imagen"]["name"] != "") {
            if (!Utilidades::imgFormatoCorrecto($archivos["imagen"]["type"])) {
                return 11;
            }
            if (!Utilidades::isValidImgSize($archivos["imagen"]["size"])) {
                return 12;
            }
        }


        return 0;
    }

    private function createJugador($datos, $archivos) {
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
        return $jugador;
    }

    private function guardarImagen($archivos, $nombreImagen, $ext) {
        $resultado = move_uploaded_file($archivos["imagen"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams/assets/img/jugador/uploads/" . $nombreImagen . "." . $ext);
        return $resultado;
    }

}
