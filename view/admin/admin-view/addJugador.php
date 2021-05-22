<script src="../assets/js/addJugador.js"></script>
<h1>Añadir jugador</h1>
<form method="post" action="?c=jugador&a=add" enctype = "multipart/form-data">
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == 2) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El nombre no puede estar vacio.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == 1) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El nombre no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Apellido 1 -->
            <div class="mb-3">
                <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Primer apellido *</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo isset($_POST["apellido1"]) ? $_POST["apellido1"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == 4) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El apellido no puede estar vacio.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == 3) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El apellido no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Apellido 2 -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo isset($_POST["apellido2"]) ? $_POST["apellido2"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == 5) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El apellido no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- dni -->
            <div class="mb-3">
                <label for="nombre" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo isset($_POST["dni"]) ? $_POST["dni"] : "" ?>" aria-describedby="dniHelp">
                <small id="dniHelp" class="form-text text-muted">DNI con letra, por ejemplo 38273637S</small>
            </div>
            <?php
            if (isset($error)) {
                if ($error == 10) {
                    echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El DNI no es válido.</div>';
                }
            }
            ?>
            <!-- Género -->
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero">
                    <option value="masculino" <?php echo isset($_POST["genero"]) ? $_POST["genero"] == "masculino" ? "selected" : "" : "" ?>>Masculino</option>
                    <option value="femenino" <?php echo isset($_POST["genero"]) ? $_POST["genero"] == "femenino" ? "selected" : "" : "" ?>>Femenino</option>
                </select>
            </div>
            <!-- fecha de nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac" value="<?php echo isset($_POST["fechaNac"]) ? $_POST["fechaNac"] : "" ?>" aria-describedby="fechaNacimientoHelp">
                <small id="fechaNacimientoHelp" class="form-text text-muted">Formato dd/mm/aaaa</small>
                <?php
                if (isset($error)) {
                    if ($error == 6) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: La fecha de nacimiento no es válida.</div>';
                    }
                }
                ?>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : "" ?>">
                <?php
                if (isset($error)) {
                    if ($error == 7) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El teléfono no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Imagen -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" value="<?php echo isset($_POST["imagen"]) ? $_POST["imagen"] : "" ?>" accept="image/png, image/jpeg" aria-describedby="imagenHelp">
                <small id="imagenHelp" class="form-text text-muted">Formato jpeg/png. Tamaño máximo 2GB.</small>
                <?php
                if (isset($error)) {
                    if ($error == 11) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El formato de imagen no es correcto.</div>';
                    }
                }
                if (isset($error)) {
                    if ($error == 12) {
                        echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El tamaño de imagen es superior a 2GB.</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title mb-4 fs-4">Datos Jugador</h2>
                <!-- Visible -->
                <div class="mb-3">
                    <label for="visibilidad" class="form-label">Visibilidad</label>
                    <select class="form-select" id="visibilidad" name="visibilidad" aria-describedby="visibilidadHelp">
                        <option value="1" <?php echo isset($_POST["visibilidad"]) ? $_POST["visibilidad"] == "1" ? "selected" : "" : "" ?>>Visible</option>
                        <option value="0" <?php echo isset($_POST["visibilidad"]) ? $_POST["visibilidad"] == "0" ? "selected" : "" : "" ?>>Oculto</option>
                    </select>
                    <small id="visibilidadHelp" class="form-text text-muted">Si un jugador está visible aparecerá en el listado de jugadores, si está oculto no aparecerá </small>
                </div>
                <!-- Altura -->
                <div class="mb-3">
                    <label for="altura" class="form-label">Altura</label>
                    <input type="text" class="form-control" id="altura" name="altura" value="<?php echo isset($_POST["altura"]) ? $_POST["altura"] : "" ?>" aria-describedby="alturaHelp">
                    <small id="alturaHelp" class="form-text text-muted">Formato decimal, sin añadir prefijos ni sufijos, por ejemplo 2.10</small>
                    <?php
                    if (isset($error)) {
                        if ($error == 8) {
                            echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: La altura no es válida.</div>';
                        }
                    }
                    ?>
                </div>
                <!-- Posicion -->
                <div class="mb-3">
                    <label for="posicion" class="form-label">Posicion</label>
                    <select class="form-select" id="posicion" name="posicion">
                        <option value="no especificado" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "no especificado" ? "selected" : "" : "" ?>>No especificado</option>
                        <option value="Base" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Base" ? "selected" : "" : "" ?>>Base</option>
                        <option value="Escolta" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Escolta" ? "selected" : "" : "" ?>>Escolta</option>
                        <option value="Alero" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Alero" ? "selected" : "" : "" ?>>Alero</option>
                        <option value="Ala-pivot" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Ala-pivot" ? "selected" : "" : "" ?>>Ala-pivot</option>
                        <option value="Pivot" <?php echo isset($_POST["posicion"]) ? $_POST["posicion"] == "Pivot" ? "selected" : "" : "" ?>>Pivot</option>
                    </select>
                </div>
                <!-- Extracomunitario -->
                <div class="mb-3">
                    <label for="extracomunitario" class="form-label">Extracomunitario</label>
                    <select class="form-select" id="extracomunitario" name="extracomunitario">
                        <option value="null" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "null" ? "selected" : "" : "" ?>>No especificado</option>
                        <option value="1" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "1" ? "selected" : "" : "" ?>>Si</option>
                        <option value="0" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "0" ? "selected" : "" : "" ?>>No</option>
                    </select>
                </div>
                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="null" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "null" ? "selected" : "" : "" ?>>No especificado</option>
                        <option value="1" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "1" ? "selected" : "" : "" ?>>Disponible</option>
                        <option value="0" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "0" ? "selected" : "" : "" ?>>Fichado</option>
                    </select>
                </div>
                <!-- Equipo -->
                <div class="mb-3">
                    <label for="equipo" class="form-label">Equipo</label>
                    <input type="text" class="form-control" id="equipo" name="equipo" value="<?php echo isset($_POST["equipo"]) ? $_POST["equipo"] : "" ?>">
                    <?php
                    if (isset($error)) {
                        if ($error == 9) {
                            echo '<div class="alert alert-danger mt-2" role="alert" id="mensajeError1">ERROR: El equipo no es válido.</div>';
                        }
                    }
                    ?>
                </div>
                <!-- Biografia -->
                <div class="mb-3">
                    <label for="biografia" class="form-label">Biografia</label>
                    <textarea id="biografia" name="biografia" name="biografia" class="form-control"><?php echo isset($_POST["biografia"]) ? $_POST["biografia"] : "" ?></textarea>
                </div>
                <!-- Informe -->
                <div class="mb-3">
                    <label for="informe" class="form-label">Informe</label>
                    <textarea id="informe" name="informe" name="informe" class="form-control"><?php echo isset($_POST["informe"]) ? $_POST["informe"] : "" ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Enviar -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary boton-orange">Añadir</button>
        <input type="reset" class="btn btn-secondary" value="Cancelar"></input>
        <div class="alert alert-danger mt-2 oculto" id="mensajeError"role="alert"></div>
    </div>
</form>
</main>
