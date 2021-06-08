<!DOCTYPE html>
<html lang="es">
<head>
    <title>Orange Ball Dreams</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link href="../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style-front.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/front.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
<header class="delante shadow-sm">
    <!-- Navigation bar -->
    <nav class=" container navbar navbar-expand-lg navbar-light fw-bold py-3">
        <a class="navbar-brand" href="?a=inicio">
            <img src="../assets/img/logo.png" height=50 alt="Orange Ball Dreams logo" class="align-text-top logo"
                 id="logo">
            <img src="../assets/img/logo-animado.gif" height=50 alt="Orange Ball Dreams logo"
                 class="align-text-top oculto-opacidad logo" id="logo-animado">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item me-3 text-uppercase">
                    <a class="nav-link <?php echo (isset($_GET["a"]) && $_GET["a"] == "inicio") ? "active" : "" ?>"
                       aria-current="page" href="?a=inicio">Inicio</a>
                </li>
                <li class="nav-item me-3 text-uppercase">
                    <a class="nav-link <?php echo (isset($_GET["a"]) && $_GET["a"] == "jugadores") ? "active" : "" ?>" href="?a=jugadores">Jugadores</a>
                </li>
                <li class="nav-item me-3 text-uppercase">
                    <a class="nav-link <?php echo (isset($_GET["a"]) && $_GET["a"] == "nosotros") ? "active" : "" ?>" href="?a=nosotros">Sobre nosotros</a>
                </li>
                <li class="nav-item me-5 text-uppercase">
                    <a class="nav-link <?php echo (isset($_GET["a"]) && $_GET["a"] == "contacto") ? "active" : "" ?>" href="?a=contacto">Contacto</a>
                </li>
                <li class="nav-item text-uppercase d-none d-lg-block">
                    <a class="nav-link nav-button-bold" href="tel:654565565">654-565-565</a>
                </li>
            </ul>
        </div>
    </nav>
</header>