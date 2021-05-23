<?php

// Necesitaremos usar sesiones así que abrimos aquí la sesión
session_start();
include_once '../controller/admin/AdminControllerJugador.php';
include_once '../controller/admin/AdminControllerUsuario.php';
include_once '../controller/admin/AdminControllerEquipo.php';

// Obtener parámetros de la sesión
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Obtener controlador y acción solicitada
$getController = isset($_GET['c']) ? ucfirst($_GET['c']) : null;
$getAction = isset($_GET['a']) ? $_GET['a'] : null;

$controllerName = "AdminController" . $getController;

if ($usuario == null) {
    $getAction = "login";
    $controlador = new AdminControllerUsuario();
    $controlador->$getAction();
} else {
    if ($getController != null) {
        // Si hay controller pero no acción la acción predeterminada será listar
        if ($getAction == null) {
            $getAction = "list";
        }
        $controlador = new $controllerName();
        $controlador->$getAction();
    } else {
        if ($getAction == null) {
            // Si hay definido un usuario y no hay controller el default será Jugador
            $getAction = "list";
            $controlador = new AdminControllerJugador();
            $controlador->$getAction();
        }
    }
}

