<h1>Añadir contacto</h1>
<form method="post" action="?c=contacto&a=add" onsubmit="return validarFormContacto()">
    <?php
    if (isset($db_error)) {
        ?>
        <div class=" card border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe un contacto con el mismo nombre y apellidos.";
                } else if ($db_error == CodigosError::db_generic_error) {
                    echo "Error en la base de datos. Contacte con el administrador del sitio.";
                }
                ?>
            </div>
        </div>
    <?php }
    ?>
    <div class="card mb-3 border-0">
        <div class="card-body row">
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
                     role="alert" id="errorTelefonoInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Equipo -->
            <div class="mb-3 col-12 col-md-6">
                <label for="equipo" class="form-label">Equipo</label>
                <input list="equipos" autocomplete="off" class="form-control" id="equipo" name="equipo"
                       value="<?php echo isset($_POST["equipo"]) ? $_POST["equipo"] : "" ?>">
                <datalist id="equipos">
                    <?php foreach ($listadoNombresEquipos

                    as $equipo): ?>
                    <option value="<?php echo $equipo["nombre"] ?>">
                        <?php endforeach; ?>
                </datalist>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::equipo_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorEquipoInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Nota -->
            <div class="col-12">
                <label for="nota" class="form-label">Nota</label>
                <textarea id="nota" name="nota"
                          class="form-control"><?php echo isset($_POST["nota"]) ? $_POST["nota"] : "" ?></textarea>
            </div>
            <!-- Enviar -->
            <div class="row mt-4">
                <div class="mt-4">
                    <button type="submit" class="btn boton-menu">Añadir</button>
                </div>
            </div>
        </div>
    </div>
</form>
</main>
