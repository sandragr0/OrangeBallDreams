<?php

// Autoloaders
spl_autoload_register('autoloadDB');
spl_autoload_register('autoloadControlador');
spl_autoload_register('autoloadModelEntidad');
spl_autoload_register('autoloadModelDAO');
spl_autoload_register('autoloadutilidades');

function autoloadDB($className)
{
    $filename = __DIR__ . "/../DB/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

function autoloadControlador($className)
{
    $filename = __DIR__ . "/../controller/admin/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

function autoloadModelEntidad($className)
{
    $filename = __DIR__ . "/../model/entity/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

function autoloadModelDAO($className)
{
    $filename = __DIR__ . "/../model/dao/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

function autoloadutilidades($className)
{
    $filename = __DIR__ . "/../utility/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

// Necesitaremos usar sesiones así que abrimos aquí la sesión
session_start();

// Obtener parámetros de la sesión
if (isset($_COOKIE["UsuarioRecordar"])) {
    $modelo = new UsuarioDAO();
    $modelo->createSesionUsuario($_COOKIE["UsuarioRecordar"]);
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Obtener controlador y acción solicitada
$getController = isset($_GET['c']) ? ucfirst($_GET['c']) : null;
$getAction = isset($_GET['a']) ? $_GET['a'] : null;

$controllerName = "AdminController" . $getController;
try {
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
} catch (Exception $e) {
    Utilidades::logError($e);
    ?>
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <div class="container-fluid h-100 bg-danger p-5">
        <div class="container h-100 p-5 bg-white rounded d-flex justify-content-center align-content-center flex-wrap shadow flex-wrap">
            <div class="row px-5">
                <div class="col">
                    <p class="fs-1 fw-bold">Se ha producido un error.</p>
                </div>
            </div>
            <div class="row px-5">
                <div class="col">
                    <p class="fs-3">Contacte al administrador del sitio.
                        Se ha producido el siguiente error:<br/>
                        <?php echo $e->getMessage() ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
}
