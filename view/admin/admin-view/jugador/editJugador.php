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
    <div class="card mb-3 border-0">
        <div class="card-body row">
            <h2 class="card-title mb-3 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : $objeto->getNombre() ?>">
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
                       value="<?php echo isset($_POST["dni"]) ? $_POST["dni"] : $objeto->getDni() ?>">
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::dni_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El DNI no es válido.</div>';
                    }
                }
                ?>
            </div>
            <!-- Género -->
            <div class="mb-3 col-12 col-md-6">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero">
                    <option value="masculino" <?php
                    if (isset($_POST["genero"])) {
                        if ($_POST["genero"] == "masculino") {
                            echo "selected";
                        }
                    } else {
                        if ($objeto->getGenero() == "masculino") {
                            echo "selected";
                        }
                    }
                    ?>>
                        Masculino
                    </option>
                    <option value="femenino" <?php
                    if (isset($_POST["genero"])) {
                        if ($_POST["genero"] == "femenino") {
                            echo "selected";
                        }
                    } else {
                        if ($objeto->getGenero() == "femenino") {
                            echo "selected";
                        }
                    }
                    ?>>
                        Femenino
                    </option>
                </select>
            </div>
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
            <!-- fecha de nacimiento -->
            <div class="mb-3 col-12 col-md-6">
                <label for="fechaNac" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Fecha
                    de nacimiento *</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac"
                       value="<?php echo isset($_POST["fechaNac"]) ? $_POST["fechaNac"] : $objeto->getFechaNacimiento() ?>"
                       aria-describedby="fechaNacimientoHelp">
                <small id="fechaNacimientoHelp" class="form-text text-muted">Formato dd/mm/aaaa</small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::fechaNac_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: La fecha de nacimiento no es válida.</div>';
                    }
                    if ($error == CodigosError::fechaNac_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no puede estar vacio.</div>';
                    }
                }
                ?>
            </div>
            <div class="w-100"></div>
            <!-- Nacionalidades -->
            <div class="mb-3 col-12 col-md-6">
                <label class="form-label">Nacionalidades</label>
                <div id="caja-nacionalidades" class="p-1">
                    <input class="form-control w-auto" type="text" onkeyup="filtrarNacionalidades()"
                           id="filtroNacionalidades" placeholder="Buscar nacionalidades...">
                    <?php
                    if ($listadoNacionalidades != null) {
                        for ($i = 0; $i < sizeof($listadoNacionalidades); $i++) { ?>
                            <div class="form-check my-2"
                                 data-id="<?php echo $listadoNacionalidades[$i]->getNombre() ?>">
                                <input class="form-check-input" type="checkbox" name="nacionalidad[]"
                                       value="<?php echo $listadoNacionalidades[$i]->getIdNacionalidad() ?>" <?php
                                if (isset($_POST["nacionalidad"])) {
                                    if (in_array($listadoNacionalidades[$i]->getIdNacionalidad(), $_POST["nacionalidad"])) {
                                        echo "checked";
                                    }
                                } else {
                                    $nacionalidadesJugador = $objeto->getNacionalidades();
                                    if ($nacionalidadesJugador != null) {
                                        for ($j = 0; $j < sizeof($nacionalidadesJugador); $j++) {
                                            if ($nacionalidadesJugador[$j]->getIdNacionalidad() == $listadoNacionalidades[$i]->getIdNacionalidad()) {
                                                echo " checked";
                                            }
                                        }
                                    }
                                }
                                ?>
                                ><label class="form-check-label">
                                    <?php echo $listadoNacionalidades[$i]->getNombre() ?>
                                </label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Imagen -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Imagen</label>
                <img src="<?php echo ".." . $objeto->getRuta() ?>"
                     class="rounded-circle shadow-sm d-block my-2" alt="<?php echo $objeto->getFullName() ?>"
                     height="90">
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
            <h2 class="card-title mt-4 mb-3 fs-4">Datos Jugador</h2>
            <!-- Visible -->
            <div class="mb-3 col-12 col-md-6">
                <label for="visibilidad" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Visibilidad *</label>
                <select class="form-select" id="visibilidad" name="visibilidad" aria-describedby="visibilidadHelp">
                    <option value="1" <?php
                    if (isset($_POST["visibilidad"])) {
                        echo $_POST["visibilidad"] == "1" ? "selected" : "";
                    } else {
                        echo $objeto->getVisible() == "1" ? "selected" : "";
                    }
                    ?>>Visible
                    </option>
                    <option value="0" <?php
                    if (isset($_POST["visibilidad"])) {
                        echo $_POST["visibilidad"] == "0" ? "selected" : "";
                    } else {
                        echo $objeto->getVisible() == "0" ? "selected" : "";
                    }
                    ?>>Oculto
                    </option>
                </select>
                <small id="visibilidadHelp" class="form-text text-muted">Si un jugador está visible aparecerá en el
                    listado de jugadores, si está oculto no aparecerá </small>
            </div>
            <!-- Altura -->
            <div class="mb-3 col-12 col-md-6">
                <label for="altura" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Altura
                    *</label>
                <input type="text" class="form-control" id="altura" name="altura"
                       value="<?php echo isset($_POST["altura"]) ? $_POST["altura"] : $objeto->getAltura() ?>"
                       aria-describedby="alturaHelp">
                <small id="alturaHelp" class="form-text text-muted">Formato decimal, sin añadir prefijos ni sufijos,
                    por ejemplo 2.10</small>
                <?php
                if (isset($error)) {
                    if ($error == CodigosError::altura_invalid) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: La altura no es válida.</div>';
                    }
                    if ($error == CodigosError::altura_empty) {
                        echo '<div class="alert alert-danger mt-2" role="alert">ERROR: El campo no puede estar vacio.</div>';
                    }
                }
                ?>
            </div>
            <!-- Posicion -->
            <div class="mb-3 col-12 col-md-6">
                <label for="posicion" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Posicion
                    *</label>
                <select class="form-select" id="posicion" name="posicion">
                    <option value="Base" <?php
                    if (isset($_POST["posicion"])) {
                        echo $_POST["posicion"] == "Base" ? "selected" : "";
                    } else {
                        echo $objeto->getPosicion() == "Base" ? "selected" : "";
                    }
                    ?>>Base
                    </option>
                    <option value="Escolta" <?php
                    if (isset($_POST["posicion"])) {
                        echo $_POST["posicion"] == "Escolta" ? "selected" : "";
                    } else {
                        echo $objeto->getPosicion() == "Escolta" ? "selected" : "";
                    }
                    ?>>
                        Escolta
                    </option>
                    <option value="Alero" <?php
                    if (isset($_POST["posicion"])) {
                        echo $_POST["posicion"] == "Alero" ? "selected" : "";
                    } else {
                        echo $objeto->getPosicion() == "Alero" ? "selected" : "";
                    }
                    ?>>Alero
                    </option>
                    <option value="Ala-pivot" <?php
                    if (isset($_POST["posicion"])) {
                        echo $_POST["posicion"] == "Ala-pivot" ? "selected" : "";
                    } else {
                        echo $objeto->getPosicion() == "Ala-pivot" ? "selected" : "";
                    }
                    ?>>
                        Ala-pivot
                    </option>
                    <option value="Pivot" <?php
                    if (isset($_POST["posicion"])) {
                        echo $_POST["posicion"] == "Pivot" ? "selected" : "";
                    } else {
                        echo $objeto->getPosicion() == "Pivot" ? "selected" : "";
                    }
                    ?>>Pivot
                    </option>
                </select>
            </div>
            <!-- Extracomunitario -->
            <div class="mb-3 col-12 col-md-6">
                <label for="extracomunitario" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Extracomunitario *</label>
                <select class="form-select" id="extracomunitario" name="extracomunitario">
                    <option value="1" <?php
                    if (isset($_POST["extracomunitario"])) {
                        if ($_POST["extracomunitario"] == "1") {
                            echo "selected";
                        }
                    } else {
                        if ($objeto->getExtracomunitario() == "1") {
                            echo "selected";
                        }
                    }
                    ?>>Si
                    </option>
                    <option value="0" <?php
                    if (isset($_POST["extracomunitario"])) {
                        if ($_POST["extracomunitario"] == "0") {
                            echo "selected";
                        }
                    } else {
                        if ($objeto->getExtracomunitario() == "0") {
                            echo "selected";
                        }
                    }
                    ?>>No
                    </option>
                </select>
            </div>
            <!-- Estado -->
            <div class="mb-3 col-12 col-md-6">
                <label for="estado" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Estado
                    *</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="disponible" <?php
                    if (isset($_POST["estado"])) {
                        echo $_POST["estado"] == "disponible" ? "selected" : "";
                    } else {
                        echo $objeto->getEstado() == "disponible" ? "selected" : "";
                    }
                    ?>>
                        Disponible
                    </option>
                    <option value="fichado" <?php
                    if (isset($_POST["estado"])) {
                        echo $_POST["estado"] == "fichado" ? "selected" : "";
                    } else {
                        echo $objeto->getEstado() == "fichado" ? "selected" : "";
                    }
                    ?>>
                        Fichado
                    </option>
                </select>
            </div>
            <!-- Equipo -->
            <div class="mb-3 col-12 col-md-6">
                <label for="equipo" class="form-label">Equipo</label>
                <input list="equipos" class="form-control" id="equipo" name="equipo"
                       value="<?php echo isset($_POST["equipo"]) ? $_POST["equipo"] : $objeto->getEquipo() ?>">
                <datalist id="equipos">
                    <?php
                    foreach ($listadoNombresEquipos

                    as $equipo):
                    ?>
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
                          class="form-control"><?php echo isset($_POST["biografia"]) ? $_POST["biografia"] : $objeto->getBiografia() ?></textarea>
            </div>
            <!-- Informe -->
            <div class="mb-3 col-12 col-md-6">
                <label for="informe" class="form-label">Informe</label>
                <textarea id="informe" name="informe"
                          class="form-control"><?php echo isset($_POST["informe"]) ? $_POST["informe"] : $objeto->getInforme() ?></textarea>
            </div>

            <!-- Enviar -->
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary boton-primario">Editar</button>
            </div>
        </div>
    </div>
</form>
</main>
