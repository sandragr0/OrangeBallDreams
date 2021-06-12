<?php

// Autoloaders
spl_autoload_register('autoloadDB');
spl_autoload_register('autoloadControlador');
spl_autoload_register('autoloadModelEntidad');
spl_autoload_register('autoloadModelDAO');
spl_autoload_register('autoloadutilidades');

/**
 * Function autoloadDB
 * @param $className
 */
function autoloadDB($className)
{
    $filename = __DIR__ . "/../DB/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

/**
 * Function autoloadControlador
 * @param $className
 */
function autoloadControlador($className)
{
    $filename = __DIR__ . "/../controller/front/FrontController.php";
    if (file_exists($filename)) {
        include_once($filename);
    }
}

/**
 * Function autoloadModelEntidad
 * @param $className
 */
function autoloadModelEntidad($className)
{
    $filename = __DIR__ . "/../model/entity/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

/**
 * Function autoloadModelDAO
 * @param $className
 */
function autoloadModelDAO($className)
{
    $filename = __DIR__ . "/../model/dao/" . $className . ".php";
    if (file_exists($filename)) {
        include($filename);
    }
}

/**
 * Function autoloadutilidades
 * @param $className
 */
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
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Obtener acción solicitada
$getAction = isset($_GET['a']) ? $_GET['a'] : "inicio";

$controlador = new FrontController();


$controlador->$getAction();

