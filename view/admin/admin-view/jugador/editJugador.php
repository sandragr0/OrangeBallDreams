<?php include_once '../utility/Utilidades.php'; ?>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=jugador&a=list" class="boton-menu">Volver</a>
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Editar jugador</h1>

        </div>
    </div>
</div>
<form method="post" action="?c=jugador&a=edit&id=<?php echo $_GET["id"] ?>" enctype="multipart/form-data">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card  border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe un jugador con el mismo nombre y apellidos.";
                } else {
                    echo "Error en la base de datos. Contacte con el administrador del sitio.";
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title mb-2 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo $objeto->getNombre() ?>">
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
                       value="<?php echo $objeto->getPrimerApellido() ?>">
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
                       value="<?php echo $objeto->getSegundoApellido() ?>">
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
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $objeto->getDni() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::dni_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El DNI no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Género -->
            <div class="mb-3">
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
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac"
                       value="<?php echo $objeto->getFechaNacimiento() ?>" aria-describedby="fechaNacimientoHelp">
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
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                       value="<?php echo $objeto->getTelefono() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::telefono_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El teléfono no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Imagen -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Imagen</label>
                <img src="<?php echo ".." . $objeto->getRuta() ?>"
                     class="img-fluid rounded-circle shadow-sm d-block my-2" alt="<?php echo $objeto->getFullName() ?>"
                     width="200">
                <input type="hidden" name="antiguaRuta" value="<?php echo $objeto->getRuta() ?>">
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
            <h2 class="card-title mt-5 mb-2 fs-4">Datos Jugador</h2>
            <!-- Visible -->
            <div class="mb-3">
                <label for="visibilidad" class="form-label">Visibilidad</label>
                <select class="form-select" id="visibilidad" name="visibilidad" aria-describedby="visibilidadHelp">
                    <option value="1" <?php echo $objeto->getVisible() == "1" ? "selected" : "" ?>>Visible</option>
                    <option value="0" <?php echo $objeto->getVisible() == "0" ? "selected" : "" ?>>Oculto</option>
                </select>
                <small id="visibilidadHelp" class="form-text text-muted">Si un jugador está visible aparecerá en el
                    listado de jugadores, si está oculto no aparecerá </small>
            </div>
            <!-- Altura -->
            <div class="mb-3">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura" name="altura"
                       value="<?php echo $objeto->getAltura() ?>" aria-describedby="alturaHelp">
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
            <div class="mb-3">
                <label for="posicion" class="form-label">Posicion</label>
                <select class="form-select" id="posicion" name="posicion">
                    <option value="no especificado" <?php echo $objeto->getPosicion() == "no especificado" ? "selected" : "" ?>>
                        No especificado
                    </option>
                    <option value="Base" <?php echo $objeto->getPosicion() == "Base" ? "selected" : "" ?>>Base
                    </option>
                    <option value="Escolta" <?php echo $objeto->getPosicion() == "Escolta" ? "selected" : "" ?>>
                        Escolta
                    </option>
                    <option value="Alero" <?php echo $objeto->getPosicion() == "Alero" ? "selected" : "" ?>>Alero
                    </option>
                    <option value="Ala-pivot" <?php echo $objeto->getPosicion() == "Ala-pivot" ? "selected" : "" ?>>
                        Ala-pivot
                    </option>
                    <option value="Pivot" <?php echo $objeto->getPosicion() == "Pivot" ? "selected" : "" ?>>Pivot
                    </option>
                </select>
            </div>
            <!-- Extracomunitario -->
            <div class="mb-3">
                <label for="extracomunitario" class="form-label">Extracomunitario</label>
                <select class="form-select" id="extracomunitario" name="extracomunitario">
                    <option value="no especificado" <?php echo $objeto->getExtracomunitario() == "no especificado" ? "selected" : "" ?>>
                        No especificado
                    </option>
                    <option value="si" <?php echo $objeto->getExtracomunitario() == "si" ? "selected" : "" ?>>Si
                    </option>
                    <option value="no" <?php echo $objeto->getExtracomunitario() == "no" ? "selected" : "" ?>>No
                    </option>
                </select>
            </div>
            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="null" <?php echo $objeto->getEstado() == "null" ? "selected" : "" ?>>
                        No especificado
                    </option>
                    <option value="disponible" <?php echo $objeto->getEstado() == "disponible" ? "selected" : "" ?>>
                        Disponible
                    </option>
                    <option value="fichado" <?php echo $objeto->getEstado() == "fichado" ? "selected" : "" ?>>
                        Fichado
                    </option>
                </select>
            </div>
            <!-- Equipo -->
            <div class="mb-3">
                <label for="equipo" class="form-label">Equipo</label>
                <input type="text" class="form-control" id="equipo" name="equipo"
                       value="<?php echo $objeto->getEquipo() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::equipo_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El equipo no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Biografia -->
            <div class="mb-3">
                <label for="biografia" class="form-label">Biografia</label>
                <textarea id="biografia" name="biografia"
                          class="form-control"><?php echo $objeto->getBiografia() ?></textarea>
            </div>
            <!-- Informe -->
            <div class="mb-3">
                <label for="informe" class="form-label">Informe</label>
                <textarea id="informe" name="informe"
                          class="form-control"><?php echo $objeto->getInforme() ?></textarea>
            </div>

            <!-- Enviar -->
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary boton-primario">Editar</button>
                <button type="submit" class="btn btn-secondary boton-primario">Cancelar</button>
                <div class="alert alert-danger mt-2 oculto" id="mensajeError" role="alert"></div>
            </div>
        </div>
    </div>
</form>
</main>