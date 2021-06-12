<h1>Añadir estadistica</h1>
<form method="post" action="?c=estadistica&a=add" onsubmit="return validarFormEstadistica()">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card  border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe una estadística para esta temporada.";
                } else {
                    echo "Error en la base de datos. Contacte con el administrador del sitio.";
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="card border-0 mb-3">
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
            <h2 class="card-title mt-4 fs-4">Estadistica</h2>
            <!-- Temporada -->
            <div class="mb-3 col-12 col-md-6">
                <label for="temporada" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Temporada *</label>
                <input type="text" autocomplete="off" list="datalistOptions" class="form-control" id="temporada"
                       name="temporada"
                       value="<?php echo isset($_POST["temporada"]) ? $_POST["temporada"] : "" ?>">
                <datalist id="datalistOptions">
                    <option value="<?php echo date("y") - 1 . "-" . date("y") ?>">
                    <option value="<?php echo date("y") - 2 . "-" . date("y") - 1 ?>">
                    <option value="<?php echo date("y") - 3 . "-" . date("y") - 2 ?>">
                    <option value="<?php echo date("y") - 4 . "-" . date("y") - 3 ?>">
                </datalist>
                <small id="temporadaHelp" class="form-text text-muted">Formato YY-YY. Por ejemplo 20-21 </small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::temporada_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorTemporadaEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::temporada_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorTemporadaInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Nombre equipo -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombreEquipo" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Nombre equipo
                    *</label>
                <input type="text" class="form-control" id="nombreEquipo" name="nombreEquipo"
                       value="<?php echo isset($_POST["nombreEquipo"]) ? $_POST["nombreEquipo"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::nombre_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorNombreEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::nombre_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorNombreInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- Nombre Liga -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombreLiga" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">Liga *</label>
                <input type="text" class="form-control" id="nombreLiga" name="nombreLiga"
                       value="<?php echo isset($_POST["nombreLiga"]) ? $_POST["nombreLiga"] : "" ?>">
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::liga_empty ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorLigaEmpty">ERROR: El campo no puede estar vacio.
                </div>
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::liga_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorLigaInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- PPP -->
            <div class="mb-3 col-12 col-md-6">
                <label for="PPP" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">PPP</label>
                <input type="text" class="form-control" id="PPP" name="PPP"
                       aria-describedby="PPPHelp"
                       value="<?php echo isset($_POST["PPP"]) ? $_POST["PPP"] : "" ?>">
                <small id="PPPHelp" class="form-text text-muted">Puntos por partido. Número entero o decimal con punto
                    como separador, por ejemplo 3 o 3.4</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::ppp_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPPPInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- APP -->
            <div class="mb-3 col-12 col-md-6">
                <label for="APP" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">APP</label>
                <input type="text" class="form-control" id="APP" name="APP"
                       aria-describedby="APPHelp"
                       value="<?php echo isset($_POST["APP"]) ? $_POST["APP"] : "" ?>">
                <small id="APPHelp" class="form-text text-muted">Asistencias por partido. Número entero o decimal con
                    punto como separador, por ejemplo 3 o 3.4</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::app_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorAPPInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- RPP -->
            <div class="mb-3 col-12 col-md-6">
                <label for="RPP" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">RPP</label>
                <input type="text" class="form-control" id="RPP" name="RPP"
                       aria-describedby="RPPHelp"
                       value="<?php echo isset($_POST["RPP"]) ? $_POST["RPP"] : "" ?>">
                <small id="RPPHelp" class="form-text text-muted">Rebotes por partido. Número entero o decimal con punto
                    como separador, por ejemplo 3 o 3.4</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::rpp_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorRPPInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- %T2 -->
            <div class="mb-3 col-12 col-md-6">
                <label for="porcentajeDobles" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">%2T</label>
                <input type="text" class="form-control" id="porcentajeDobles" name="porcentajeDobles"
                       aria-describedby="porcentajeDoblesHelp"
                       value="<?php echo isset($_POST["porcentajeDobles"]) ? $_POST["porcentajeDobles"] : "" ?>">
                <small id="porcentajeDoblesHelp" class="form-text text-muted">Porcentaje de tiros dobles. Número entero
                    o decimal separado por punto sin añadir símbolo %, por ejemplo 70 o 50.5</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::porcentajeTirosDobles_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPorcentajeTirosDoblesInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- %T3 -->
            <div class="mb-3 col-12 col-md-6">
                <label for="porcentajeTriples" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">%T3</label>
                <input type="text" class="form-control" id="porcentajeTriples" name="porcentajeTriples"
                       aria-describedby="porcentajeTriplesHelp"
                       value="<?php echo isset($_POST["porcentajeTriples"]) ? $_POST["porcentajeTriples"] : "" ?>">
                <small id="porcentajeTriplesHelp" class="form-text text-muted">Porcentaje de tiros triples. Número
                    entero o decimal separado por punto sin añadir símbolo %, por ejemplo 70 o 50.5</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::porcentajeTirosTriples_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPorcentajeTirosTriplesInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- %TL -->
            <div class="mb-3 col-12 col-md-6">
                <label for="porcentajeTL" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">%TL</label>
                <input type="text" class="form-control" id="porcentajeTL" name="porcentajeTL"
                       aria-describedby="porcentajeTLHelp"
                       value="<?php echo isset($_POST["porcentajeTL"]) ? $_POST["porcentajeTL"] : "" ?>">
                <small id="porcentajeTLHelp" class="form-text text-muted">Porcentaje de tiros libres. Número entero o
                    decimal separado por punto sin añadir símbolo %, por ejemplo 70 o 50.5</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::porcentajeTirosLibres_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorPorcentajeTirosLibresInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- TAP -->
            <div class="mb-3 col-12 col-md-6">
                <label for="TAP" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">TAP</label>
                <input type="text" class="form-control" id="TAP" name="TAP"
                       aria-describedby="TAPHelp"
                       value="<?php echo isset($_POST["TAP"]) ? $_POST["TAP"] : "" ?>">
                <small id="TAPHelp" class="form-text text-muted">Tapones. Número entero o decimal con punto como
                    separador, por ejemplo 3 o 3.4</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::tap_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorTAPInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- ROB -->
            <div class="mb-3 col-12 col-md-6">
                <label for="ROB" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">ROB</label>
                <input type="text" class="form-control" id="ROB" name="ROB"
                       aria-describedby="ROBHelp"
                       value="<?php echo isset($_POST["ROB"]) ? $_POST["ROB"] : "" ?>">
                <small id="ROBHelp" class="form-text text-muted">Robos. Número entero o decimal con punto como
                    separador, por ejemplo 3 o 3.4</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::rob_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorROBInvalid">ERROR: El campo no es válido.
                </div>
            </div>
            <!-- MIN -->
            <div class="col-12 col-md-6">
                <label for="MIN" class="form-label" data-toggle="tooltip" data-placement="top"
                       title="Obligatorio">MIN</label>
                <input type="text" class="form-control" id="MIN" name="MIN"
                       aria-describedby="MINHelp"
                       value="<?php echo isset($_POST["MIN"]) ? $_POST["MIN"] : "" ?>">
                <small id="MINHelp" class="form-text text-muted">Minutos por partido. Número entero de hasta 3
                    cifras</small>
                <!-- Mensajes errores -->
                <div class="alert alert-danger mt-2 <?php echo(isset($error) && $error == CodigosError::min_invalid ? "d-block" : "d-none") ?> error"
                     role="alert" id="errorMINInvalid">ERROR: El campo no es válido.
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