<?php

/**
 * Class AdminControllerVideo
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class AdminControllerVideo extends AdminController
{
    /**
     * @var \VideoDAO
     */
    private $model;
    /**
     * @var \JugadorDAO
     */
    private $modelJugador;
    /**
     * @var string
     */
    private $controllerName = "Video";

    /**
     * AdminControllerVideo constructor.
     */
    public function __construct()
    {
        $this->model = new VideoDAO();
        $this->modelJugador = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    /**
     * Function delete
     */
    public function delete()
    {
        parent::delete();
        // Redirigir a la página actual
        header('Location:?c=video&a=list');
    }

    /**
     * Function list
     */
    public function list()
    {
        include_once '../view/admin/admin-panel-header.php';
        $listaVideos = $this->model->list();

        $json = json_encode($listaVideos, JSON_PRETTY_PRINT);

        $file = fopen(Utilidades::getDocumentRoot() . '/assets/data/videos.json', 'w');
        fwrite($file, $json);
        fclose($file);


        $jugadores = $this->getJugadores();

        include_once "../view/admin/admin-view/" . $this->controllerName . "/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    /**
     * Function add
     * @return void
     */
    function add()
    {
        $jugadores = $this->getAllJugadores();
        if ($jugadores != null) {
            if (sizeof($_POST) == 0) {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/" . $this->controllerName . "/add" . $this->controllerName . ".php";
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
                        include_once "../view/admin/admin-view/" . $this->controllerName . "/add" . $this->controllerName . ".php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                } else {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/add" . $this->controllerName . ".php";
                    include_once '../view/admin/admin-panel-footer.php';
                }
            }
        } else {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/addErrorJugador.php";
            include_once '../view/admin/admin-panel-footer.php';
        }
    }

    /**
     * Function edit
     * @return void
     */
    function edit()
    {
        if (isset($_REQUEST['id'])) {
            $video = $this->model->view($_REQUEST['id']);
        } else {
            $video = null;
        }

        if ($video == null) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/error.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $jugadores = $this->getAllJugadores();
            if ($jugadores != null) {
                if (sizeof($_POST) == 0) {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/" . $this->controllerName . "/edit" . $this->controllerName . ".php";
                    include_once '../view/admin/admin-panel-footer.php';
                } else {
                    $error = $this->validarVideo($_POST);
                    if ($error == 0) {
                        $video = $this->createVideo($_POST);
                        try {
                            $this->model->edit($_REQUEST["id"], $video);
                            header('Location: admin.php?c=video&a=list');
                        } catch (Exception $e) {
                            Utilidades::logError($e);
                            if ($e->getCode() == 23000) {
                                $db_error = CodigosError::db_duplicate_entry;
                            } else {
                                $db_error = CodigosError::db_generic_error;
                            }
                            include_once '../view/admin/admin-panel-header.php';
                            include_once "../view/admin/admin-view/" . $this->controllerName . "/edit" . $this->controllerName . ".php";
                            include_once '../view/admin/admin-panel-footer.php';
                        }
                    } else {
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/" . $this->controllerName . "/edit" . $this->controllerName . ".php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/addErrorJugador.php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }

    /**
     * Function getAllJugadores
     * @return array|null
     */
    private function getAllJugadores(): ?array
    {
        return $this->modelJugador->getJugadores();
    }

    /**
     * Function getJugadores
     * @return array|null
     */
    private function getJugadores(): ?array
    {
        return $this->modelJugador->getJugadoresWithVideos();
    }

    /**
     * Function validarVideo
     * @param $datos
     * @return int
     */
    private function validarVideo($datos): int
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

    /**
     * Function createVideo
     * @param $datos
     * @return \Video
     */
    private function createVideo($datos): Video
    {
        $video = new Video();
        $video->setIdJugador($datos["jugador"]);
        $video->setRuta(Utilidades::cleanValue($datos["ruta"]));
        $video->setTipoVideo($datos["tipoVideo"]);
        $video->setIsPublico($datos["isPublico"]);
        return $video;
    }
}