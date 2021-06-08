<?php

class FrontController
{
    public function inicio()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/inicio.php';
        include_once '../view/front/footer.php';
    }

    public function jugadores()
    {
        $jugadorDAO = new JugadorDAO();
        $jugadores = $jugadorDAO->getJugadoresVisibles();
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/jugadores.php';
        include_once '../view/front/footer.php';
    }

    public function nosotros()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/sobreNosotros.php';
        include_once '../view/front/footer.php';
    }

    public function contacto()
    {
        include_once '../view/front/header.php';
        include_once '../view/front/front-view/contacto.php';
        include_once '../view/front/footer.php';
    }

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