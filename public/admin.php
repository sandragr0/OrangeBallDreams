<?php
// Necesitaremos usar sesiones así que abrimos aquí la sesión
session_start();

include_once '../controller/admin/AdminController.php';

// Obtener parámetros de la sesión y la URL
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$getController = isset($_GET['c']) ? ucfirst($_GET['c']) : null;
$getAction = isset($_GET['a']) ? $_GET['a'] : null;

if ($getController != null) {
    // Si hay controller pero no acción la acción predeterminada será listar
    if ($getAction == null) {
        $getAction = "list";
    }
    $controlador = new AdminController($getController);
    $controlador->$getAction();
} else {
    if ($getAction == null) {
        // Si no hay definido un usuario la acción principal será Loguear
        if ($usuario == null) {
            $getAction = "login";
            $controlador = new AdminController();
            $controlador->$getAction();
        } else {
            // Si hay definido un usuario y no hay controller el default será Jugador
            $_GET['c'] = "jugador";
            $_GET['a'] = "list";
            $getController = "Jugador";
            $getAction = "list";
            $controlador = new AdminController($getController);
            $controlador->$getAction();
        }
    }
}
