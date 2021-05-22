<?php

include_once('../utility/Utilidades.php');
include_once('../utility/CodigosError.php');

/**
 * Class AdminController
 */
class AdminController {

    /**
     * @var mixed
     */
    private $model;
    /**
     * @var
     */
    private $controllerName;

    /**
     * AdminController constructor.
     * @param $controllerName
     * @param $model
     */
    public function __construct($controllerName, $model) {
        $this->controllerName = $controllerName;
        $this->model = new $model();
    }

    /**
     *
     */
    public function list() {
        $this->model->list();
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     * @param object $object
     */
    public function insert(object $object) {
        $this->model->insert($object);
    }

    /**
     *
     */
    public function add() {

    }

    /**
     *
     */
    public function view() {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = $this->model->view(1);
        }
        include_once '../view/admin/admin-panel-header.php';
        if ($objeto == null) {
            include_once "../view/admin/admin-view/error.php";
        } else {
            include_once "../view/admin/admin-view/view" . $this->controllerName . ".php";
        }
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     *
     */
    public function edit() {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->view($_REQUEST['id']);
        } else {
            $objeto = $this->model->view(1);
        }

        include_once '../view/admin/admin-panel-header.php';
        if ($objeto == null) {
            include_once "../view/admin/admin-view/error.php";
        } else {
            include_once "../view/admin/admin-view/edit" . $this->controllerName . ".php";
        }

        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     *
     */
    public function delete() {
        if (isset($_REQUEST['id'])) {
            $objeto = $this->model->delete($_REQUEST['id']);
             header('Location:'.$_SERVER["PHP_SELF"]);
        } 
    }

}
