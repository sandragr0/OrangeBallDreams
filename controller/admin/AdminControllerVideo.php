<?php

class AdminControllerVideo extends AdminController
{
    private $model;
    private $modelJugador;
    private $controllerName = "Video";

    public function __construct()
    {
        $this->model = new VideoDAO();
        $this->modelJugador = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function delete()
    {
        parent::delete();
        // Redirigir a la página actual
        header('Location:?c=video&a=list');
    }

    public function list()
    {
        include_once '../view/admin/admin-panel-header.php';
        $listaVideos = $this->model->list();

        $json = json_encode($listaVideos, JSON_PRETTY_PRINT);

        $file = fopen(Utilidades::getDocumentRoot() . '/assets/data/videos.json', 'w');
        fwrite($file, $json);
        fclose($file);


        $jugadores = $this->getJugadores();

        include_once "../view/admin/admin-view/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    function add()
    {
        $jugadores = $this->getJugadores();
        if ($jugadores != null) {
            if (sizeof($_POST) == 0) {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                include_once '../view/admin/admin-panel-footer.php';
            } else {
                $error = $this->validarVideo($_POST);
                if ($error == 0) {
                    $video = $this->createVideo($_POST);
                    try {
                        $this->model->add($video);
                        header('Location: admin.php?c=video&a=list');
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
        } else {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/add" . $this->controllerName . "ErrorJugador" . ".php";
            include_once '../view/admin/admin-panel-footer.php';
        }
    }

    function edit()
    {
        // TODO: Implement edit() method.
    }

    private function getJugadores()
    {
        return $this->modelJugador->getJugadores();
    }

    private function validarVideo($datos)
    {
        // Ruta
        if (Utilidades::isEmpty($datos["ruta"])) {
            return CodigosError::ruta_empty;
        } else {
            if (!Utilidades::isRuta($datos["ruta"])) {
                return CodigosError::ruta_invalid;
            }
        }
        // Sin fallos
        return 0;

    }

    private function createVideo($datos)
    {
        $video = new Video();
        $video->setIdJugador($datos["jugador"]);
        $video->setRuta(Utilidades::cleanValue($datos["ruta"]));
        $video->setTipoVideo($datos["tipoVideo"]);
        $video->setIsPublico($datos["isPublico"]);
        return $video;
    }
}