<html>
    <head>
    <html lang="es">
        <title>Orange Ball Dreams</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/bootstrap/css/bootstrap.min.css">
        <link href="../../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
        <link href="../../assets/css/style-admin.css" rel="stylesheet">
        <script src="../../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/admin-login.js"></script>

    </head>
    <body>
        <div class="container-fluid bg-lightgrey bg-gradient py-5 h-100">
            <img src="../../assets/img/logo.png" class="img-fluid h-25 mx-auto d-block pb-sm-5 pb-4">
            <div class="container formLogin bg-white shadow  rounded p-4">
                 <div class="alert alert-danger mt-2 oculto" id="mensajeError3"role="alert">ERROR: El usuario o contraseña que has introducido no es correcto.</div>
                <form onsubmit="return checkFormulario()">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="user">
                    </div>
                    <div class="alert alert-danger mt-2 oculto" id="mensajeError1"role="alert"></div>
                    <!-- Contraseña -->
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password">
                        <span class="input-group-text" style="width:3em;" id="basic-addon1" onclick="visibilidadPass()"><i class="fas fa-eye" id="ojo"></i></span>
                    </div>
                    <div class="alert alert-danger mt-2 oculto" id="mensajeError2"role="alert"></div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                    </div>
                    <button type="submit" class="btn btn-secondary">Acceder</button>
                </form>
            </div>
        </div>
    </body>
</html>