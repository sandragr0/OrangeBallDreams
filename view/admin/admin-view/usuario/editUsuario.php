<h1>Editar usuario</h1>
<form method="post" action="?c=usuario&a=edit&id=<?php echo $_GET["id"] ?>" onsubmit="return validarFormUsuario()">
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
    <div class="card border-0 mb-3">
        <div class="card-body row">
            <!-- Datos del usuario -->
            <!-- Nombre del usuario -->
            <div>
                <input type="hidden" class="form-control" id="nombreUsuario" name="nombreUsuario"
                       value="<?php echo $objeto->getNombreUsuario() ?>">
            </div>
            <!-- Correo electrónico -->
            <div>
                <input type="hidden" class="form-control" id="correoElectronico" name="correoElectronico"
                       value="<?php echo $objeto->getCorreoElectronico() ?>">
            </div>
            <!-- Contraseña -->
            <div>
                <div class="input-group">
                    <input type="hidden" name="contraseña" class="form-control" id="password"
                           value="<?php echo $objeto->getContraseña() ?>">
                    <input type="hidden" name="modoEdicion" class="form-control" id="modoEdicion"
                           value="true">
                </div>
            </div>
            <!-- Rol -->
            <div>
                <select hidden class="form-select" id="rol" name="rol">
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
                       value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : $objeto->getNombre() ?>">
                <small class="text-muted">El usuario puede tener letras tanto mayúsculas como minúsculas y números. Debe
                    tener una longitud de entre 6 y 8 carácteres</small>
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
                       value="<?php echo isset($_POST["apellido1"]) ? $_POST["apellido1"] : $objeto->getPrimerApellido() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::apellido1_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El apellido no puede estar vacio.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == CodigosError::apellido1_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El apellido no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Apellido 2 -->
            <div class="mb-3 col-12 col-md-6">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2"
                       value="<?php echo isset($_POST["apellido2"]) ? $_POST["apellido2"] : $objeto->getSegundoApellido() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::apellido2_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El apellido no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- dni -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni"
                       value="<?php echo isset($_POST["dni"]) ? $_POST["dni"] : $objeto->getDni() ?>"
                       aria-describedby="dniHelp">
                <small id="dniHelp" class="form-text text-muted">DNI con letra, por ejemplo 38273637S</small>
            </div>
            <?php
            if (isset($error)) {
                if ($error == CodigosError::dni_invalid) {
                    echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El DNI no es válido.</div>';
                }
            }
            ?>
            <!-- Telefono -->
            <div class="mb-3 col-12 col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                       value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : $objeto->getTelefono() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::telefono_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El teléfono no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Enviar -->
            <div class="mt-4">
                <button type="submit" class="btn boton-menu">Guardar cambios</button>
            </div>
        </div>
    </div>
</form>
</main>