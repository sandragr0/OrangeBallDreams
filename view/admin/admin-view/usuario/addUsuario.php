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
    <div class="card border-0 mb-3">
        <div class="card-body">
            <!-- Datos del usuario -->
            <h2 class="card-title mb-4 fs-4">Datos del usuario</h2>
            <!-- Nombre del usuario -->
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Nombre de usuario *</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario"
                       value="<?php echo isset($_POST["nombreUsuario"]) ? $_POST["nombreUsuario"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::usuario_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no puede estar vacio</div>';
                    }
                    if ($error == CodigosError::usuario_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no es válido</div>';
                    }
                }
                ?>
            </div>
            <!-- Correo electrónico -->
            <div class="mb-3">
                <label for="correoElectronico" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Correo electrónico *</label>
                <input type="tel" class="form-control" id="correoElectronico" name="correoElectronico"
                       value="<?php echo isset($_POST["correoElectronico"]) ? $_POST["correoElectronico"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::correo_electronico_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no puede estar vacio</div>';
                    }
                    if ($error == CodigosError::correo_electronico_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no es válido</div>';
                    }
                }
                ?>
            </div>
            <!-- Contraseña -->
            <div class="mb-3">
                <label for="contraseña" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Contraseña *</label>
                <div class="input-group mb-3">
                    <input type="password" name="contraseña" class="form-control" aria-describedby="passwordHelp" id="password"
                           value="<?php echo isset($_POST['contraseña']) ? $_POST['contraseña'] : "" ?>">
                    <span class="input-group-text" style="width:3em;" id="basic-addon1" onclick="visibilidadPass()"><i
                                class="fas fa-eye" id="ojo"></i></span>
                </div>
                <small id="passwordHelp" class="form-text text-muted">
                    <p class="mb-1">La contraseña debe tener como mínimo 8 carácteres de longitud.</p>
                    <p class="mb-1">La contraseña debe tener como mínimo una letra mayúscula.</p>
                    <p class="mb-1">La contraseña debe tener como mínimo una letra minúscula.</p>
                    <p class="mb-1"> La contraseña debe tener como mínimo un número o caracter especial.</p>
                </small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::pass_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no puede estar vacio</div>';
                    }
                    if ($error == CodigosError::pass_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no es válido</div>';
                    }
                }
                ?>
            </div>
            <!-- Rol -->
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" aria-describedby="rolHelp">
                    <option value="usuario" <?php echo isset($_POST["rol"]) ? $_POST["rol"] == "usuario" ? "selected" : "" : "" ?>>
                        Usuario
                    </option>
                    <option value="administrador" <?php echo isset($_POST["rol"]) ? $_POST["rol"] == "administrador" ? "selected" : "" : "" ?>>
                        Administrador
                    </option>
                </select>
                <small id="rol" class="form-text text-muted">Los usuarios con rol de administrador pueden acceder al
                    panel de administración. Los usuarios con rol usuario pueden acceder al área privada de
                    usuarios</small>
            </div>

            <!-- Datos personales -->
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::nombre_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El nombre no puede estar vacio.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == CodigosError::nombre_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El nombre no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Apellido 1 -->
            <div class="mb-3">
                <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Primer apellido *</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1"
                       value="<?php echo isset($_POST["apellido1"]) ? $_POST["apellido1"] : "" ?>">
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
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2"
                       value="<?php echo isset($_POST["apellido2"]) ? $_POST["apellido2"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::apellido2_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El apellido no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- dni -->
            <div class="mb-3">
                <label for="nombre" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni"
                       value="<?php echo isset($_POST["dni"]) ? $_POST["dni"] : "" ?>" aria-describedby="dniHelp">
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
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                       value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::telefono_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El teléfono no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Enviar -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary boton-orange">Añadir</button>
                <input type="reset" class="btn btn-secondary" value="Cancelar"></input>
                <div class="alert alert-danger mt-2 oculto" id="mensajeError" role="alert"></div>
            </div>
        </div>
    </div>
</form>
</main>
