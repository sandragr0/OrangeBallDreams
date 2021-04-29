<?php

session_start();
include_once '../controller/admin/AdminController.php';
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$getController = isset($_GET['c']) ? ucfirst($_GET['c']) : null;
$getAction = isset($_GET['a']) ? $_GET['a'] : null;

if ($getController != null) {
    if ($getAction == null) {
        $getAction = "view";
    }
    $controlador = new AdminController($getController);
    $controlador->$getAction();
} else {
    if ($getAction == null) {
        if ($usuario == null) {
            $getAction = "login";
            $controlador = new AdminController();
            $controlador->$getAction();
        } else {
            $getController = "Jugador";
            $getAction = "view";
            $controlador = new AdminController($getController);
            $controlador->$getAction();
        }
    }
}
