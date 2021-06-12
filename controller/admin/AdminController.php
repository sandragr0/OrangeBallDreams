<?php

/**
 * Class AdminController
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
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
     * Function list
     */
    public function list()
    {
        $this->model->list();
        include_once '../view/admin/admin-panel-header.php';
        include_once "../view/admin/admin-view/" . $this->controllerName . "/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     * Function view
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
            include_once "../view/admin/admin-view/" . $this->controllerName . "/view" . $this->controllerName . ".php";
        }
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     * Function add
     * @return mixed
     */
    abstract function add();

    /**
     * Function edit
     * @return mixed
     */
    abstract function edit();

    /**
     * Function delete
     */
    public function delete()
    {
        if (isset($_REQUEST['id'])) {
            $this->model->delete($_REQUEST['id']);
            header("Location: admin.php?c=$this->controllerName&a=list");
        }
    }
}
