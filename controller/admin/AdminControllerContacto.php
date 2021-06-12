<?php


class AdminControllerContacto extends AdminController
{
    private $model;
    private $controllerName = "contacto";
    private $modelEquipo;

    public function __construct()
    {
        $this->model = new ContactoDAO();
        $this->modelEquipo = new EquipoDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    /**
     * @inheritDoc
     */
    function add()
    {
        $listadoNombresEquipos = $this->modelEquipo->getNombresEquipos();
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/" . $this->controllerName . "/addContacto.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $error = $this->validarDatos($_POST);
            if ($error == 0) {
                $contacto = $this->createContacto($_POST);
                try {
                    $this->model->add($contacto);
                    header('Location: admin.php?c=contacto&a=list');
                } catch (Exception $e) {
                    Utilidades::logError($e);
                    if ($e->getCode() == 23000) {
                        $db_error = CodigosError::db_duplicate_entry;
                    } else {
                        $db_error = CodigosError::db_generic_error;
                    }
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/addContacto.php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/addContacto.php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }

    private function validarDatos($datos)
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

        if ($datos["telefono"] != "") {
            if (!Utilidades::isTelefono($datos["telefono"])) {
                return CodigosError::telefono_invalid;
            }
        }

        if ($datos["nota"] != "") {
            if (!Utilidades::isAlpha($datos["nota"])) {
                return CodigosError::nota_invalid;
            }
        }

        if ($datos["equipo"] != "") {
            if (!Utilidades::isAlpha($datos["equipo"])) {
                return CodigosError::equipo_invalid;
            }
        }

    }

    public function delete()
    {
        parent::delete();
        header('Location: admin.php?c=contacto&a=list');
    }


    private function createContacto($datos): Contacto
    {
        // Limpiar datos y mapearlos
        $contacto = new Contacto();
        $contacto->setNombre(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["nombre"])));
        $contacto->setPrimerApellido(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido1"])));
        $contacto->setSegundoApellido(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["apellido2"])));
        $contacto->setDni(mb_strtoupper(Utilidades::cleanValue($datos["dni"])));
        $contacto->setTelefono(mb_strtoupper(Utilidades::cleanValue($datos["telefono"])));
        $contacto->setNota(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["nota"])));
        $contacto->setIdEquipo(Utilidades::mb_ucfirst(Utilidades::cleanValue($datos["equipo"])));
        return $contacto;
    }

    /**
     * @inheritDoc
     */
    function edit()
    {
        $listadoNombresEquipos = $this->modelEquipo->getNombresEquipos();
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
                include_once "../view/admin/admin-view/" . $this->controllerName . "/editContacto.php";
                include_once '../view/admin/admin-panel-footer.php';
            } else {
                $error = $this->validarDatos($_POST);
                if ($error == 0) {
                    $contacto = $this->createContacto($_POST);
                    try {
                        $this->model->edit($_REQUEST['id'], $contacto);
                        header('Location: admin.php?c=contacto&a=list');
                    } catch (Exception $e) {
                        Utilidades::logError($e);
                        if ($e->getCode() == 23000) {
                            $db_error = CodigosError::db_duplicate_entry;
                        } else {
                            $db_error = CodigosError::db_generic_error;
                        }
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/" . $this->controllerName . "/editContacto.php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                } else {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/editContacto.php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            }
        }

    }
}