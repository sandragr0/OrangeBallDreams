<h1>Añadir usuario</h1>
<form method="post" action="?c=usuario&a=add" enctype="multipart/form-data">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe un usuario con el mismo nombre y apellidos.";
                } else if ($db_error == CodigosError::db_generic_error) {
                    echo "Error en la base de datos. Contacte con el administrador del sitio.";
                }
                ?>
            </div>
        </div>
    <?php }
    ?>
    <div class="card border-0">
        <div class="card-body row">
            <!-- Datos del usuario -->
            <h2 class="card-title mb-4 fs-4">Datos del usuario</h2>
            <!-- Nombre del usuario -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombreUsuario" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Nombre de usuario *</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario"
                       value="<?php echo isset($_POST["nombreUsuario"]) ? $_POST["nombreUsuario"] : "" ?>">
                <small class="text-muted">El usuario puede tener letras tanto mayúsculas como minúsculas y números. Debe
                    tener una longitud de entre 6 y 8 carácteres</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::usuario_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorUsuarioEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::usuario_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorUsuarioInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Correo electrónico -->
            <div class="mb-3 col-12 col-md-6">
                <label for="correoElectronico" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Correo electrónico *</label>
                <input type="tel" class="form-control" id="correoElectronico" name="correoElectronico"
                       value="<?php echo isset($_POST["correoElectronico"]) ? $_POST["correoElectronico"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::correo_electronico_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorEmailEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::correo_electronico_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorEmailInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Contraseña -->
            <div class="mb-3 col-12 col-md-6">
                <label for="contraseña" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Contraseña *</label>
                <div class="input-group mb-3">
                    <input type="password" name="contraseña" class="form-control" aria-describedby="passwordHelp"
                           id="contraseña"
                           value="<?php echo isset($_POST['contraseña']) ? $_POST['contraseña'] : "" ?>">
                    <span class="input-group-text" style="width:3em;" id="basic-addon1" onclick="visibilidadPass()"><i
                                class="fas fa-eye" id="ojo"></i></span>
                </div>
                <small id="passwordHelp" class="form-text text-muted">
                    La contraseña debe tener como mínimo 8 carácteres de longitud. Debe tener como mínimo una letra mayúscula y una minúscula y un número o caracter especial.
                </small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::pass_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPassEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::pass_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPassInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Rol -->
            <div class="mb-3 col-12 col-md-6">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol">
                    <option value="administrador" <?php echo isset($_POST["rol"]) ? $_POST["rol"] == "administrador" ? "selected" : "" : "" ?>>
                        Administrador
                    </option>
                </select>
            </div>

            <!-- Datos personales -->
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::nombre_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorNombreEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::nombre_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorNombreInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Apellido 1 -->
            <div class="mb-3 col-12 col-md-6">
                <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Primer apellido *</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1"
                       value="<?php echo isset($_POST["apellido1"]) ? $_POST["apellido1"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::apellido1_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorApellido1Empty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::apellido1_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorApellido1Invalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Apellido 2 -->
            <div class="mb-3 col-12 col-md-6">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2"
                       value="<?php echo isset($_POST["apellido2"]) ? $_POST["apellido2"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::apellido2_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorApellido2Invalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- dni -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni"
                       value="<?php echo isset($_POST["dni"]) ? $_POST["dni"] : "" ?>" aria-describedby="dniHelp">
                <small id="dniHelp" class="form-text text-muted">DNI con letra, por ejemplo 38273637S</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::dni_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorDniInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Telefono -->
            <div class="mb-3 col-12 col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                       value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::telefono_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errortTelefonoInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Enviar -->
            <div class="row mt-4">
                <div class="col">
                    <button type="submit" class="btn boton-menu">Añadir</button>
                </div>
            </div>
        </div>
    </div>
</form>
</main>
