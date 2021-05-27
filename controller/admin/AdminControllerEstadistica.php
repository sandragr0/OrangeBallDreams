<?php
require_once('AdminController.php');
require_once('../model/dao/EstadisticaDAO.php');

class AdminControllerEstadistica extends AdminController
{
    private $model;
    private $controllerName = "Estadistica";

    public function __construct()
    {
        $this->model = new EstadisticaDAO();
        parent::__construct($this->controllerName, $this->model);
    }

public function list()
{
    include_once '../view/admin/admin-panel-header.php';
    $list = $this->model->list();
    // Crear json
    $json = json_encode($list,JSON_PRETTY_PRINT);
    $file = fopen(Utilidades::getDocumentRoot(). '/assets/estadisticas.json', 'w');
    fwrite($file, $json);
    fclose($file);
    $jugadores = $this->model->getJugadores();
    include_once "../view/admin/admin-view/list" . $this->controllerName . ".php";
    include_once '../view/admin/admin-panel-footer.php';

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
                        include_once '../view/admin/admin-panel-header.php';
                        include_once "../view/admin/admin-view/add" . $this->controllerName . ".php";
                        include_once '../view/admin/admin-panel-footer.php';
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
        $estadistica->setTemporada(Utilidades::cleanString($datos["temporada"]));
        $estadistica->setNombreEquipo(Utilidades::cleanString($datos["nombreEquipo"]));
        $estadistica->setNombreLiga(Utilidades::cleanString($datos["nombreLiga"]));
        $estadistica->setPPP(Utilidades::cleanString($datos["PPP"]));
        $estadistica->setAPP(Utilidades::cleanString($datos["APP"]));
        $estadistica->setRPP(Utilidades::cleanString($datos["RPP"]));
        $estadistica->setPorcentajeDobles(Utilidades::cleanString($datos["porcentajeDobles"]));
        $estadistica->setPorcentajeTriples(Utilidades::cleanString($datos["porcentajeTriples"]));
        $estadistica->setPorcentajeTL(Utilidades::cleanString($datos["porcentajeTL"]));
        $estadistica->setTAP(Utilidades::cleanString($datos["TAP"]));
        $estadistica->setROB(Utilidades::cleanString($datos["ROB"]));
        $estadistica->setMIN(Utilidades::cleanString($datos["MIN"]));
        return $estadistica;
    }

    private function getJugadores()
    {
        return $this->model->getJugadores();
    }
}