<h1>Añadir video</h1>
<form method="post" action="?c=video&a=add" onsubmit="return validarFormVideo()">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya has añadido ese vídeo.";
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
            <h2 class="card-title mb-4 fs-4">Jugador</h2>
            <div class="col-12 mb-3">
                <div class="input-group">
                    <span class="input-group-text" id="buscarNombre"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="inputBuscarNombre" placeholder="Buscar por nombre..."
                           onkeyup="buscarJugador()"
                           aria-describedby="buscarNombre">
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="jugador" class="form-label">Jugador<i id="search-icon"></i></label>
                <select autofocus class="form-select" id="jugador" name="jugador">
                    <?php foreach ($jugadores as $jugador): ?>
                        <option value="<?php echo $jugador->getIdJugador(); ?>" <?php echo (isset($_POST["jugador"]) && $_POST["jugador"] == $jugador->getIdJugador()) ? "selected" : "" ?>>
                            <?php echo $jugador->getFullName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <h2 class="card-title mt-4 fs-4">Video</h2>
            <!-- Ruta -->
            <div class="mb-3 col-12 col-md-12">
                <label for="ruta" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Link del vídeo
                    *</label>
                <input type="text" class="form-control" id="ruta" name="ruta" aria-describedby="rutaHelp"
                       value="<?php echo isset($_POST["ruta"]) ? $_POST["ruta"] : "" ?>">
                <small id="rutaHelp" class="form-text text-muted">Ruta del vídeo. <a href="#" data-bs-toggle='modal'
                                                                                     data-bs-target='#rutaHelpModel'>¿Necesitas
                        ayuda?</a></small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::ruta_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorRutaEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::ruta_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorRutaInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- isPublico -->
            <div class="mb-3 col-12 col-md-6">
                <label for="isPublico" class="form-label">Visibilidad</label>
                <select class="form-select" id="isPublico" name="isPublico">
                    <option value="1" <?php echo isset($_POST["isPublico"]) ? $_POST["isPublico"] == "1" ? "selected" : "" : "" ?>>
                        Público
                    </option>
                    <option value="0" <?php echo isset($_POST["isPublico"]) ? $_POST["isPublico"] == "0" ? "selected" : "" : "" ?>>
                        Privado
                    </option>
                </select>
            </div>
            <!-- Tipo de video -->
            <div class="col-12 col-md-6">
                <label for="tipoVideo" class="form-label">Visibilidad</label>
                <select class="form-select" id="tipoVideo" name="tipoVideo">
                    <option value="highlight" <?php echo isset($_POST["tipoVideo"]) ? $_POST["tipoVideo"] == "highlight" ? "selected" : "" : "" ?>>
                        Highlight
                    </option>
                    <option value="partido" <?php echo isset($_POST["tipoVideo"]) ? $_POST["tipoVideo"] == "partido" ? "selected" : "" : "" ?>>
                        Partido completo
                    </option>
                </select>
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

<!-- Modal -->
<div class="modal fade" id="rutaHelpModel" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir videos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>En un ordenador, ve al vídeo de YouTube que quieras insertar.</li>
                    <li> Debajo del vídeo, haz clic en Compartir.</li>
                    <li> Haz clic en Insertar.</li>
                    <li>En el cuadro de texto que aparece, copia el link del vídeo.<img
                                src="../assets/img/admin/video/AddVideoHelp1.png" class="d-block img-fluid mt-2 mb-3"
                                alt="VideoHelp1"></li>

                    <li> Pega el enlace del vídeo.<img src="../assets/img/admin/video/AddVideoHelp2.png"
                                                       class="d-block img-fluid mt-2 mb-3" alt="VideoHelp2"></li>
                </ol>
            </div>
        </div>
    </div>
</div>
</main>