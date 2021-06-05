<script src="../assets/js/addJugador.js"></script>
<h1>Añadir jugador</h1>
<form method="post" action="?c=jugador&a=add" enctype="multipart/form-data">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe un jugador con el mismo nombre y apellidos.";
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
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3 col-12 col-md-6">
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
            <div class="mb-3 col-12 col-md-6">
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
            <div class="mb-3 col-12 col-md-6">
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
            <div class="mb-3 col-12 col-md-6">
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
            <!-- Género -->
            <div class="mb-3 col-12 col-md-6">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero">
                    <option value="masculino" <?php echo isset($_POST["genero"]) ? $_POST["genero"] == "masculino" ? "selected" : "" : "" ?>>
                        Masculino
                    </option>
                    <option value="femenino" <?php echo isset($_POST["genero"]) ? $_POST["genero"] == "femenino" ? "selected" : "" : "" ?>>
                        Femenino
                    </option>
                </select>
            </div>
            <!-- fecha de nacimiento -->
            <div class="mb-3 col-12 col-md-6">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac"
                       value="<?php echo isset($_POST["fechaNac"]) ? $_POST["fechaNac"] : "" ?>"
                       aria-describedby="fechaNacimientoHelp">
                <small id="fechaNacimientoHelp" class="form-text text-muted">Formato dd/mm/aaaa</small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::fechaNac_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: La fecha de nacimiento no es válida.</div>';
                    }
                }
                ?>
            </div>
            <!-- Telefono -->
            <div class="mb-3 col-12 col-md-6">
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
            <!-- Imagen -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/png, image/jpeg"
                       aria-describedby="imagenHelp">
                <small id="imagenHelp" class="form-text text-muted">Formato jpeg/png. Tamaño máximo 2GB.</small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::imagen_wrong_format) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El formato de imagen no es correcto.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == CodigosError::imagen_wrong_size) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El tamaño de imagen es superior a 2GB.</div>';
                    }
                }
                ?>
            </div>
            <!-- Nacionalidades -->
            <div class="mb-3 col-12 col-md-6">
                <div id="caja-nacionalidades" class="p-1">
                    <label class="form-label">Nacionalidades</label>
                    <input class="form-control w-auto" type="text" onkeyup="filtrarNacionalidades()"
                           id="filtroNacionalidades" placeholder="Buscar nacionalidades...">
                    <?php
                    if ($nacionalidades != null) {
                        foreach ($nacionalidades as $nacionalidad) {
                            ?>
                            <div class="form-check my-2" data-id="<?php echo $nacionalidad->getNombre() ?>">
                                <input class="form-check-input" type="checkbox" name="nacionalidad[]"
                                       value="<?php echo $nacionalidad->getIdNacionalidad() ?>" <?php echo isset($_POST["nacionalidad"]) && in_array($nacionalidad->getIdNacionalidad(), $_POST["nacionalidad"]) ? "checked" : "" ?>>
                                <label class="form-check-label">
                                    <?php echo $nacionalidad->getNombre() ?>
                                </label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <h2 class="card-title mb-4 fs-4">Datos Jugador</h2>
            <!-- Visible -->
            <div class="mb-3 col-12 col-md-6">
                <label for="visibilidad" class="form-label">Visibilidad</label>
                <select class="form-select" id="visibilidad" name="visibilidad" aria-describedby="visibilidadHelp">
                    <option value="1" <?php echo isset($_POST["visibilidad"]) ? $_POST["visibilidad"] == "1" ? "selected" : "" : "" ?>>
                        Visible
                    </option>
                    <option value="0" <?php echo isset($_POST["visibilidad"]) ? $_POST["visibilidad"] == "0" ? "selected" : "" : "" ?>>
                        Oculto
                    </option>
                </select>
                <small id="visibilidadHelp" class="form-text text-muted">Si un jugador está visible aparecerá en el
                    listado de jugadores, si está oculto no aparecerá </small>
            </div>
            <!-- Altura -->
            <div class="mb-3 col-12 col-md-6">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura" name="altura"
                       value="<?php echo isset($_POST["altura"]) ? $_POST["altura"] : "" ?>"
                       aria-describedby="alturaHelp">
                <small id="alturaHelp" class="form-text text-muted">Formato decimal, sin añadir prefijos ni sufijos,
                    por ejemplo 2.10</small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::altura_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: La altura no es válida.</div>';
                    }
                }
                ?>
            </div>
            <!-- Posicion -->
            <div class="mb-3 col-12 col-md-6">
                <label for="posicion" class="form-label">Posicion</label>
                <select class="form-select" id="posicion" name="posicion">
                    <option value="no especificado" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "no especificado" ? "selected" : "" : "" ?>>
                        No especificado
                    </option>
                    <option value="Base" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Base" ? "selected" : "" : "" ?>>
                        Base
                    </option>
                    <option value="Escolta" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Escolta" ? "selected" : "" : "" ?>>
                        Escolta
                    </option>
                    <option value="Alero" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Alero" ? "selected" : "" : "" ?>>
                        Alero
                    </option>
                    <option value="Ala-pivot" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Ala-pivot" ? "selected" : "" : "" ?>>
                        Ala-pivot
                    </option>
                    <option value="Pivot" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Pivot" ? "selected" : "" : "" ?>>
                        Pivot
                    </option>
                </select>
            </div>
            <!-- Extracomunitario -->
            <div class="mb-3 col-12 col-md-6">
                <label for="extracomunitario" class="form-label">Extracomunitario</label>
                <select class="form-select" id="extracomunitario" name="extracomunitario">
                    <option value="null" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "null" ? "selected" : "" : "" ?>>
                        No especificado
                    </option>
                    <option value="1" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "1" ? "selected" : "" : "" ?>>
                        Si
                    </option>
                    <option value="0" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "0" ? "selected" : "" : "" ?>>
                        No
                    </option>
                </select>
            </div>
            <!-- Estado -->
            <div class="mb-3 col-12 col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="null" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "null" ? "selected" : "" : "" ?>>
                        No especificado
                    </option>
                    <option value="disponible" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "disponible" ? "selected" : "" : "" ?>>
                        Disponible
                    </option>
                    <option value="fichado" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "fichado" ? "selected" : "" : "" ?>>
                        Fichado
                    </option>
                </select>
            </div>
            <!-- Equipo -->
            <div class="mb-3 col-12 col-md-6">
                <label for="equipo" class="form-label">Equipo</label>
                <input list="equipos" class="form-control" id="equipo" name="equipo"
                       value="<?php echo isset($_POST["equipo"]) ? $_POST["equipo"] : "" ?>">
                <datalist id="equipos">
                    <?php foreach ($listadoNombresEquipos

                    as $equipo): ?>
                    <option value="<?php echo $equipo["nombre"] ?>">
                        <?php endforeach; ?>
                </datalist>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::equipo_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El equipo no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Biografia -->
            <div class="mb-3 col-12 col-md-6">
                <label for="biografia" class="form-label">Biografia</label>
                <textarea id="biografia" name="biografia"
                          class="form-control"><?php echo isset($_POST["biografia"]) ? $_POST["biografia"] : "" ?></textarea>
            </div>
            <!-- Informe -->
            <div class="mb-3 col-12 col-md-6">
                <label for="informe" class="form-label">Informe</label>
                <textarea id="informe" name="informe"
                          class="form-control"><?php echo isset($_POST["informe"]) ? $_POST["informe"] : "" ?></textarea>
            </div>
            <!-- Enviar -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary boton-orange">Añadir</button>
                <div class="alert alert-danger mt-2 oculto" id="mensajeError" role="alert"></div>
            </div>
        </div>
    </div>
</form>
</main>
