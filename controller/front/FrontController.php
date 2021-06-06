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
}