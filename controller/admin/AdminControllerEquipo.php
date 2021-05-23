<?php
require_once('AdminController.php');
require_once('../model/dao/EquipoDAO.php');

class AdminControllerEquipo extends AdminController
{
    private $model;
    private $controllerName = "Equipo";

    public function __construct()
    {
        $this->model = new EquipoDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function add()
    {
        if (sizeof($_POST) == 0) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $error = $this->validarEquipo($_POST);
            echo $error;
            if ($error == 0) {
                $equipo = new Equipo();
                $equipo->setNombre(Utilidades::cleanString($_POST["nombre"]));
                try {
                    $this->model->add($equipo);
                    header('Location: admin.php?c=equipo&a=list');
                } catch (Exception $e) {
                    Utilidades::logError($e);
                    if ($e->getCode() == 23000) {
                        $db_error = CodigosError::db_duplicate_entry;
                    } else {
                        $db_error = CodigosError::db_generic_error;
                    }
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }


    private function validarEquipo($datos) {
        if (Utilidades::isEmpty($datos["nombre"])) {
            return CodigosError::nombre_empty;
        } else {
            if (Utilidades::isAlpha($datos["nombre"])) {
                return 0;
            } else {
                return CodigosError::nombre_invalid;
            }
        }
    }

    public function list()
    {
        parent::list();
    }

    public function edit()
    {
        parent::edit();
    }

    public function view()
    {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = null;
        }
        include_once '../view/admin/admin-panel-header.php';
        if ($objeto == null) {
            include_once "../view/admin/admin-view/error.php";
        } else {
            $jugadores = $this->model->getJugadores($_REQUEST['id']);
            include_once "../view/admin/admin-view/view" . $this->controllerName . ".php";
        }
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function delete() {
        parent::delete($_GET["id"]);
        header('Location:?c=equipo&a=list');
    }

    public function deleteJugador() {
        if (isset($_REQUEST['idJugador'])) {
            $this->model->deleteJugador($_REQUEST['idJugador']);
        }
        header('Location: admin.php?c=equipo&a=view&id=' . $_GET["id"]);
    }

}