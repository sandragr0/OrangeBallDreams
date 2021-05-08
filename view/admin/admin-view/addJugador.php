<script src="../assets/js/addJugador.js"></script>

<h1>Añadir jugador</h1>
<form>
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>">
            </div>
            <!-- Apellido 1 -->
            <div class="mb-3">
                <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Primer apellido *</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo isset($_POST["apellido1"]) ? $_POST["apellido1"] : "" ?>">
            </div>
            <!-- Apellido 2 -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo isset($_POST["apellido2"]) ? $_POST["apellido2"] : "" ?>">
            </div>
            <!-- fecha de nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac" value="<?php echo isset($_POST["fechaNac"]) ? $_POST["fechaNac"] : "" ?>" aria-describedby="fechaNacimientoHelp">
                <small id="fechaNacimientoHelp" class="form-text text-muted">Formato dd/mm/aaaa</small>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : "" ?>">
            </div>
        </div>
    </div>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title mb-4 fs-4">Datos Jugador</h2>
                <!-- Altura -->
                <div class="mb-3">
                    <label for="altura" class="form-label">Altura</label>
                    <input type="text" class="form-control" id="altura" name="altura" value="<?php echo isset($_POST["altura"]) ? $_POST["altura"] : "" ?>" aria-describedby="alturaHelp">
                    <small id="alturaHelp" class="form-text text-muted">Formato decimal, sin añadir prefijos ni sufijos, por ejemplo 2.10</small>
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
                        <option value="no especificado" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "no especificado" ? "selected" : "" : "" ?>>No especificado</option>
                        <option value="si" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "si" ? "selected" : "" : "" ?>>Si</option>
                        <option value="no" <?php echo isset($_POST["extracomunitario"]) ? $_POST["extracomunitario"] == "no" ? "selected" : "" : "" ?>>No</option>
                    </select>
                </div>
                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="no especificado" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "no especificado" ? "selected" : "" : "" ?>>No especificado</option>
                        <option value="disponible" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "disponible" ? "selected" : "" : "" ?>>Disponible</option>
                        <option value="fichado" <?php echo isset($_POST["estado"]) ? $_POST["estado"] == "fichado" ? "selected" : "" : "" ?>>Fichado</option>
                    </select>
                </div>
                <!-- Equipo -->
                <div class="mb-3">
                    <label for="equipo" class="form-label">Equipo</label>
                    <input type="text" class="form-control" id="equipo" name="equipo" value="<?php echo isset($_POST["equipo"]) ? $_POST["equipo"] : "" ?>">
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
        <button type="submit" class="btn btn-secondary boton-primario">Editar</button>
        <button type="submit" class="btn btn-secondary boton-primario">Cancelar</button>
        <div class="alert alert-danger mt-2 oculto" id="mensajeError"role="alert"></div>
    </div> 
</form>
</main>


</div>
</div>
</div>
</body>
</html>
