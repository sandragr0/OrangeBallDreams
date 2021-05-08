<html>
    <head>
    <html lang="es">
        <title>Orange Ball Dreams</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
        <link href="../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
        <link href="../assets/css/style-admin.css" rel="stylesheet">
        <script src="../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/admin.js"></script>

    </head>
    <body>
        <div class="container-fluid bg-lightgrey bg-gradient py-5 h-100">
            <div class="container formLogin bg-white shadow  rounded p-4">
                <a href="#"><img src="../assets/img/logo.png" class="mx-auto d-block pb-sm-5 pb-4 img-fluid logo-login"></a>
                <div class="alert alert-danger mt-2 oculto" id="mensajeError3"role="alert">ERROR: El usuario o contraseña que has introducido no es correcto.</div>
                <?php
                if (isset($estadoErrores)) {
                    if ($estadoErrores == -3) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError4">ERROR: El usuario o contraseña que has introducido no es correcto.</div>';
                    }
                }
                ?>
                <form onsubmit="return checkFormulario()" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <!-- Usuario -->
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" name="user" id="user" value="<?php echo isset($_POST['user']) ? $_POST['user'] : "" ?>">
                    </div>
                    <div class="alert alert-danger mt-2 oculto" id="mensajeError1"role="alert">Error: el campo nombre de usuario no puede estar vacio</div>
                    <?php
                    if (isset($estadoErrores)) {
                        if ($estadoErrores == -1) {
                            echo ' <div class="alert alert-danger mt-2" role="alert" id="mensajeError5">Error: el campo nombre de usuario no puede estar vacio</div>';
                        }
                    }
                    ?>
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" id="password"  value="<?php echo isset($_POST['password']) ? $_POST['password'] : "" ?>">
                            <span class="input-group-text" style="width:3em;" id="basic-addon1" onclick="visibilidadPass()"><i class="fas fa-eye" id="ojo"></i></span>
                        </div>
                        <div class="alert alert-danger mt-2 oculto" id="mensajeError2" role="alert">Error: el campo contraseña no puede estar vacio</div>
                        <?php
                        if (isset($estadoErrores)) {
                            if ($estadoErrores == -2) {
                                echo ' <div class="alert alert-danger mt-2" role="alert" id="mensajeError6">Error: el campo contraseña no puede estar vacio</div>';
                            }
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3 boton-primario">Acceder</button>
                </form>
            </div>
        </div>

    </body>
</html>