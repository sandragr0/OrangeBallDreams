<?php

/**
 * Class FrontController
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
class FrontController
{
    /**
     * Function inicio
     */
    public function inicio()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/inicio.php';
        include_once '../view/front/footer.php';
    }

    /**
     * Function jugadores
     */
    public function jugadores()
    {
        $jugadorDAO = new JugadorDAO();
        $jugadores = $jugadorDAO->getJugadoresVisibles();
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/jugadores.php';
        include_once '../view/front/footer.php';
    }

    /**
     * Function nosotros
     */
    public function nosotros()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/sobreNosotros.php';
        include_once '../view/front/footer.php';
    }

    /**
     * Function contacto
     */
    public function contacto()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/contacto.php';
        include_once '../view/front/footer.php';
    }

    /**
     * Function jugador
     */
    public function jugador()
    {
        if (isset($_REQUEST['id'])) {
            $modelJugador = new JugadorDAO();
            $jugador = $modelJugador->view($_REQUEST['id']);
            $modelEstadisticas = new EstadisticaDAO();
            $estadisticas = $modelEstadisticas->getJugadoresWithEstadistica($_REQUEST['id']);
            $modelVideo = new VideoDAO();
            $highlights = $modelVideo->getHighlightsFromJugador($_REQUEST['id']);
            $partidosCompletos = $modelVideo->getPartidosCompletosFromJugador($_REQUEST['id']);
        } else {
            $jugador = null;
        }

        include_once '../view/front/header.php';
        if ($jugador != null) {
            include_once '../view/front/front-view/jugador.php';
        } else {
            include_once '../view/front/front-view/errorJugador.php';
        }
        include_once '../view/front/footer.php';
    }
}