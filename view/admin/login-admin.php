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
        <script src="../assets/js/admin-login.js"></script>

    </head>
    <body>
        <?php 
        if (sizeof($_POST) == 0) {

        ?>
        <div class="container-fluid bg-lightgrey bg-gradient py-5 h-100">
            <div class="container formLogin bg-white shadow  rounded p-4">
                <a href="#"><img src="../assets/img/logo.png" class="mx-auto d-block pb-sm-5 pb-4 img-fluid logo-login"></a>
                 <div class="alert alert-danger mt-2 oculto" id="mensajeError3"role="alert">ERROR: El usuario o contraseña que has introducido no es correcto.</div>
                <form onsubmit="return checkFormulario()" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" name="user" id="user">
                    </div>
                    <div class="alert alert-danger mt-2 oculto" id="mensajeError1"role="alert"></div>
                    <!-- Contraseña -->
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password">
                        <span class="input-group-text" style="width:3em;" id="basic-addon1" onclick="visibilidadPass()"><i class="fas fa-eye" id="ojo"></i></span>
                    </div>
                    <div class="alert alert-danger mt-2 oculto" id="mensajeError2"role="alert"></div>
                    <button type="submit" class="btn btn-secondary mt-3 boton-primario">Acceder</button>
                </form>
            </div>
        </div>
        <?php
        } else {
           $usuario =  isset($_POST['user']) ? $_POST['user'] : null;
           $pass =  isset($_POST['password']) ? $_POST['password'] : null;
           
           $errorUsuarioEmpty = true;
           $errorPasswordEmpty = true;
           $errorNoExiste = true;
           
           if ($usuario != null) {
               $errorUsuarioEmpty = false;
           }
           
           if ($pass != null) {
               $errorPasswordEmpty = false;
           }
           
           if ($errorUsuarioEmpty || $errorPasswordEmpty) {
               llamadaAFuncion($errorUsuarioEmpty, $errorPasswordEmpty);
           } else {
               include_once '../DB/Database.php';
    
               $conexion = Database::connect();
               
 
               $pdo = $conexion->prepare("SELECT usuario.nombre, usuario.contraseña, rol.nombre as rol FROM `usuario` left JOIN usuarios_roles on usuarios_roles.idUsuario=usuario.idUsuario left join rol on rol.idRol = usuarios_roles.idRol where usuario.usuario=? and rol.nombre =?");
               $pdo->execute(array($usuario, "administrador"));
               $data = $pdo->fetch(PDO::FETCH_ASSOC);
                
               if ($pdo->rowCount() != 0){
                   echo $pass;
                    echo "<br/>";
                    echo md5($pass);
                    echo "<br/>";
                    echo $data['contraseña'];
                     echo "<br/>";
                   if ($data['contraseña'] == md5($pass)) {
                       $errorNoExiste = false;
                   }
               } 
               
               if ($errorNoExiste) {
                   echo "el usuario no existe";
               } else {
                   session_start();
                  $_SESSION["usuario"] = $usuario;
                  header('Location: admin.php?c=jugador&a=view');
               }
           }
        }
        ?>
    </body>
</html>