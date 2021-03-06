<!DOCTYPE html>
<html lang="es">
<head>
    <title>Orange Ball Dreams</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link href="../assets/css/style-admin.css" rel="stylesheet">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/tableSort/js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="../assets/js/tableSort/css/theme.bootstrap_4.min.css">
</head>
<body>
<?php
$controller = isset($_REQUEST["c"]) ? $_REQUEST["c"] : null;
$action = isset($_REQUEST["a"]) ? $_REQUEST["a"] : null;
?>

<!-- Cabecera -->
<header class="navbar navbar-light sticky-top bg-white flex-md-nowrap p-0 align-items-center shadow-sm">
    <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bold border-end">
        <div class="image-container">
            <a href="/" target="_blank">
                <img src="../assets/img/logo.png" height="50" alt="Orange Ball Dreams logo" class="align-text-top logo"
                     id="logo">
                <img src="../assets/img/logo-animado.gif" height="50" alt="Orange Ball Dreams logo"
                     class="align-text-top logo oculto-opacidad" id="logo-animado">
            </a>
        </div>

    </div>
    <div class="d-block d-md-inline w-100 px-3">
        <span class="d-block nav-link text-md-end text-start navbar-nav">Hola, <a
                    href="?c=usuario&a=view&id=<?php echo $_SESSION['idUsuario']; ?>"><?php echo Utilidades::mb_ucfirst($_SESSION['usuario']); ?></a> | <a
                    href="?c=usuario&a=exit">Cerrar sesi??n</a></span>
    </div>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>

<!-- Menu lateral -->
<div class="container-fluid mb-2">
    <nav id="sidebarMenu" class="col-12 col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="list-unstyled ps-0">
                <!-- Jugadores -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#jugador-collapse" aria-expanded="true">
                        Jugadores
                    </button>
                    <div class="collapse show" id="jugador-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=jugador&a=list"
                                   class="link-dark rounded <?php echo ($controller == "jugador" && $action == "list") ? "active" : "" ?>">Ver
                                    jugadores</a></li>
                            <li><a href="?c=jugador&a=add"
                                   class="link-dark rounded  <?php echo ($controller == "jugador" && $action == "add") ? "active" : "" ?>">A??adir
                                    jugador</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Estadisticas -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#estadisticas-collapse" aria-expanded="true">
                        Estad??sticas
                    </button>
                    <div class="collapse show" id="estadisticas-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=estadistica&a=list"
                                   class="link-dark rounded <?php echo ($controller == "estadistica" && $action == "list") ? "active" : "" ?>">Ver
                                    estad??sticas</a></li>
                            <li><a href="?c=estadistica&a=add"
                                   class="link-dark rounded <?php echo ($controller == "estadistica" && $action == "add") ? "active" : "" ?>">A??adir
                                    estad??stica</a></li>
                        </ul>
                    </div>
                </li>
                <!-- V??deos -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#videos-collapse" aria-expanded="true">
                        V??deos
                    </button>
                    <div class="collapse show" id="videos-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=video&a=list"
                                   class="link-dark rounded <?php echo ($controller == "video" && $action == "list") ? "active" : "" ?>">Ver
                                    v??deos</a></li>
                            <li><a href="?c=video&a=add"
                                   class="link-dark rounded <?php echo ($controller == "video" && $action == "add") ? "active" : "" ?>">A??adir
                                    v??deo</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Separador -->
                <li class="border-top my-3"></li>
                <!-- Equipos -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#equipo-collapse" aria-expanded="true">
                        Equipos
                    </button>
                    <div class="collapse show" id="equipo-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=equipo&a=list"
                                   class="link-dark rounded <?php echo ($controller == "equipo" && $action == "list") ? "active" : "" ?>">Ver
                                    equipos</a></li>
                            <li><a href="?c=equipo&a=add"
                                   class="link-dark rounded <?php echo ($controller == "equipo" && $action == "add") ? "active" : "" ?>">A??adir
                                    equipo</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Contactos -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#contacto-collapse" aria-expanded="true">
                        Contactos
                    </button>
                    <div class="collapse show" id="contacto-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=contacto&a=list"
                                   class="link-dark rounded <?php echo ($controller == "contacto" && $action == "list") ? "active" : "" ?>">Ver
                                    contactos</a></li>
                            <li><a href="?c=contacto&a=add"
                                   class="link-dark rounded <?php echo ($controller == "contacto" && $action == "add") ? "active" : "" ?>">A??adir
                                    contacto</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Separador -->
                <li class="border-top my-3"></li>
                <!-- Usuarios -->
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded mb-2" data-bs-toggle="collapse"
                            data-bs-target="#usuario-collapse" aria-expanded="true">
                        Usuarios
                    </button>
                    <div class="collapse show" id="usuario-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?c=usuario&a=list"
                                   class="link-dark rounded <?php echo ($controller == "usuario" && $action == "list") ? "active" : "" ?>">Ver
                                    usuarios</a></li>
                            <li><a href="?c=usuario&a=add"
                                   class="link-dark rounded  <?php echo ($controller == "usuario" && $action == "add") ? "active" : "" ?>">A??adir
                                    usuario</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--panel info-->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 px-3">