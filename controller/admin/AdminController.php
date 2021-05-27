<?php

/**
 * Class AdminController
 */
abstract class AdminController
{

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
    public function __construct($controllerName, $model)
    {
        $this->controllerName = $controllerName;
        $this->model = new $model();
    }

    /**
     *
     */
    public function list()
    {
        $this->model->list();
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     *
     */
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
            include_once "../view/admin/admin-view/view" . $this->controllerName . ".php";
        }
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     *
     */
    abstract function add();


    /**
     *
     */
    abstract function edit();

    /**
     *
     */
    public function delete()
    {
        if (isset($_REQUEST['id'])) {
            $this->model->delete($_REQUEST['id']);
        }
    }


}
