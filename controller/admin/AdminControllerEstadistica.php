<?php
class AdminControllerEstadistica extends AdminController
{
    private $model;
    private $modelJugador;
    private $controllerName = "Estadistica";

    public function __construct()
    {
        $this->model = new EstadisticaDAO();
        $this->modelJugador = new JugadorDAO();
        parent::__construct($this->controllerName, $this->model);
    }

    public function delete()
    {
        parent::delete();
        // Redirigir a la página actual
        header('Location:?c=estadistica&a=list');
    }

    public function list()
    {
        include_once '../view/admin/admin-panel-header.php';
        $listaEstadisticas = $this->model->list();

        $json = json_encode($listaEstadisticas, JSON_PRETTY_PRINT);

        $file = fopen(Utilidades::getDocumentRoot() . '/assets/data/estadisticas.json', 'w');
        fwrite($file, $json);
        fclose($file);

        $jugadores = $this->getJugadores();

        include_once "../view/admin/admin-view/list" . $this->controllerName . ".php";
        include_once '../view/admin/admin-panel-footer.php';
    }

    public function edit()
    {
        if (isset($_REQUEST['id'])) {
            $estadistica = $this->model->view($_REQUEST['id']);
        } else {
            $estadistica = null;
        }

        if ($estadistica == null) {
            include_once '../view/admin/admin-panel-header.php';
            include_once "../view/admin/admin-view/error.php";
            include_once '../view/admin/admin-panel-footer.php';
        } else {
            $jugadores = $this->getJugadores();
            if ($jugadores != null) {
                if (sizeof($_POST) == 0) {
                    include_once '../view/admin/admin-panel-header.php';
                    include_once "../view/admin/admin-view/edit" . $this->controllerName . ".php";
                    include_once '../view/admin/admin-panel-footer.php';
                } else {
                    $error = $this->validarEstadistica($_POST);
                    if ($error == 0) {
                        $estadistica = $this->createEstadistica($_POST);
                        try {
                            $this->model->edit($_REQUEST['id'], $estadistica);
                            header('Location: admin.php?c=estadistica&a=list');
                        } catch (Exception $e) {
                            Utilidades::logError($e);
                            if ($e->getCode() == 23000) {
                                $db_error = CodigosError::db_duplicate_entry;
                            } else {
                                $db_error = CodigosError::db_generic_error;
                            }
                            include_once '../view/admin/admin-panel-header.php';
                            include_once "../view/admin/admin-view/edit" . $this->controllerName . ".php";
                            include_once '../view/admin/admin-panel-footer.php';
                        }
                    } else {
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/edit" . $this->controllerName . ".php";
                        include_once '../view/admin/admin-panel-footer.php';
                    }
                }
            } else {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/edit" . $this->controllerName . "ErrorJugador" . ".php";
                include_once '../view/admin/admin-panel-footer.php';
            }
        }
    }

    public function add()
    {
        $jugadores = $this->getJugadores();
        if ($jugadores != null) {
            if (sizeof($_POST) == 0) {
                include_once '../view/admin/admin-panel-header.php';
                include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                include_once '../view/admin/admin-panel-footer.php';
            } else {
                $error = $this->validarEstadistica($_POST);
                if ($error == 0) {
                    $estadistica = $this->createEstadistica($_POST);
                    try {
                        $this->model->add($estadistica);
                        header('Location: admin.php?c=estadistica&a=list');
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

    private function validarEstadistica($datos)
    {
        // Temporada
        if (Utilidades::isEmpty($datos["temporada"])) {
            return CodigosError::temporada_empty;
        } else {
            if (!Utilidades::isTemporada($datos["temporada"])) {
                return CodigosError::temporada_invalid;
            }
        }

        // Nombre equipo
        if (Utilidades::isEmpty($datos["nombreEquipo"])) {
            return CodigosError::nombre_empty;
        } else {
            if (!Utilidades::isAlpha($datos["nombreEquipo"])) {
                return CodigosError::nombre_invalid;
            }
        }

        // Liga
        if (Utilidades::isEmpty($datos["nombreLiga"])) {
            return CodigosError::liga_empty;
        } else {
            if (!Utilidades::isAlpha($datos["nombreLiga"])) {
                return CodigosError::liga_invalid;
            }
        }

        // PPP
        if (!Utilidades::isEmpty($datos["PPP"])) {
            if (!Utilidades::isNumeroValidoHastaDosCifras($datos["PPP"]) && !Utilidades::isDecimalHastaDosCifras($datos["PPP"])) {
                return CodigosError::ppp_invalid;
            }
        }

        // APP
        if (!Utilidades::isEmpty($datos["APP"])) {
            if (!Utilidades::isNumeroValidoHastaDosCifras($datos["APP"]) && !Utilidades::isDecimalHastaDosCifras($datos["APP"])) {
                return CodigosError::app_invalid;
            }
        }

        // RPP
        if (!Utilidades::isEmpty($datos["RPP"])) {
            if (!Utilidades::isNumeroValidoHastaDosCifras($datos["RPP"]) && !Utilidades::isDecimalHastaDosCifras($datos["RPP"])) {
                return CodigosError::rpp_invalid;
            }
        }

        // porcentajeDobles
        if (!Utilidades::isEmpty($datos["porcentajeDobles"])) {
            if (!Utilidades::isNumeroValidoHastaTresCifras($datos["porcentajeDobles"]) && !Utilidades::isDecimalHastaDosCifras($datos["porcentajeDobles"])) {
                return CodigosError::porcentajeTirosDobles_invalid;
            }
        }

        // porcentajeTriples
        if (!Utilidades::isEmpty($datos["porcentajeTriples"])) {
            if (!Utilidades::isNumeroValidoHastaTresCifras($datos["porcentajeTriples"]) && !Utilidades::isDecimalHastaDosCifras($datos["porcentajeTriples"])) {
                return CodigosError::porcentajeTirosTriples_invalid;
            }
        }
        // porcentajeTL
        if (!Utilidades::isEmpty($datos["porcentajeTL"])) {
            if (!Utilidades::isNumeroValidoHastaTresCifras($datos["porcentajeTL"]) && !Utilidades::isDecimalHastaDosCifras($datos["porcentajeTL"])) {
                return CodigosError::porcentajeTirosLibres_invalid;
            }
        }

        // TAP
        if (!Utilidades::isEmpty($datos["TAP"])) {
            if (!Utilidades::isNumeroValidoHastaDosCifras($datos["TAP"]) && !Utilidades::isDecimalHastaDosCifras($datos["TAP"])) {
                return CodigosError::tap_invalid;
            }
        }
        // ROB
        if (!Utilidades::isEmpty($datos["ROB"])) {
            if (!Utilidades::isNumeroValidoHastaDosCifras($datos["ROB"]) && !Utilidades::isDecimalHastaDosCifras($datos["ROB"])) {
                return CodigosError::rob_invalid;
            }
        }
        // MIN
        if (!Utilidades::isEmpty($datos["MIN"])) {
            if (!Utilidades::isNumeroValidoHastaTresCifras($datos["MIN"])) {
                return CodigosError::min_invalid;
            }
        }

        // Sin fallos
        return 0;

    }

    private function createEstadistica($datos)
    {
        $estadistica = new Estadistica();
        $estadistica->setIdJugador($datos["jugador"]);
        $estadistica->setTemporada(Utilidades::cleanValue($datos["temporada"]));
        $estadistica->setNombreEquipo(Utilidades::cleanValue($datos["nombreEquipo"]));
        $estadistica->setNombreLiga(Utilidades::cleanValue($datos["nombreLiga"]));
        $estadistica->setPPP(Utilidades::cleanValue($datos["PPP"]));
        $estadistica->setAPP(Utilidades::cleanValue($datos["APP"]));
        $estadistica->setRPP(Utilidades::cleanValue($datos["RPP"]));
        $estadistica->setPorcentajeDobles(Utilidades::cleanValue($datos["porcentajeDobles"]));
        $estadistica->setPorcentajeTriples(Utilidades::cleanValue($datos["porcentajeTriples"]));
        $estadistica->setPorcentajeTL(Utilidades::cleanValue($datos["porcentajeTL"]));
        $estadistica->setTAP(Utilidades::cleanValue($datos["TAP"]));
        $estadistica->setROB(Utilidades::cleanValue($datos["ROB"]));
        $estadistica->setMIN(Utilidades::cleanValue($datos["MIN"]));
        return $estadistica;
    }

    private function getJugadores()
    {
        return $this->modelJugador->getJugadores();
    }
}