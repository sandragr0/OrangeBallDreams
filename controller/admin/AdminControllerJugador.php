<?php

require_once('AdminController.php');
require_once('../model/dao/JugadorDAO.php');

class AdminControllerJugador extends AdminController
{

    private $model;
    private $controllerName = "Jugador";

    public function __construct()
    {
        $this->model = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function add()
    {
        if (sizeof($_POST) == 0) {
           $this->showAddJugador();
        } else {
            // Validar datos
            $error = $this->validarDatos($_POST, $_FILES);

            if ($error == 0) {
                // Crear objeto jugador
                $jugador = $this->createJugador($_POST, $_FILES);

                // Añadir jugador a la BD
                try {
                    $this->model->add($jugador);
                    header('Location: admin.php?c=jugador&a=list');
                } catch (Exception $e) {
                    // Loguear error
                    Utilidades::logError($e);

                    // Mostrar error
                    if ($e->getCode() == 23000) {
                        $db_error = CodigosError::db_duplicate_entry;
                    } else {
                        $db_error = CodigosError::db_generic_error;
                    }

                    $this->showAddJugador();
                }
            } else {
                $this->showAddJugador();
            }
        }
    }

    private function showAddJugador()
    {
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/addJugador.php";
        include_once '../view/admin/admin-panel-footer.php';
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

    private function guardarImagen($archivos, $nombreImagen, $ext)
    {
        $resultado = move_uploaded_file($archivos["imagen"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams/assets/img/jugador/uploads/" . $nombreImagen . "." . $ext);
        return $resultado;
    }

}
