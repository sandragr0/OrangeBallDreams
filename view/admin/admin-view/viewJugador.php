<?php include_once '../utility/Utilidades.php'; ?>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=jugador&a=list" class="boton-menu">Volver</a>
            <a href="?c=jugador&a=edit&id=<?php echo $objeto->getIdJugador() ?>" class="boton-menu">Editar</a>
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Ver jugador</h1>

        </div>
    </div>
</div>
<form>
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title mb-4 fs-4">Datos personales</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre *</label>
                <input disabled type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $objeto->getNombre() ?>">
            </div>
            <!-- Apellido 1 -->
            <div class="mb-3">
                <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Primer apellido *</label>
                <input disabled type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo $objeto->getPrimerApellido() ?>">
            </div>
            <!-- Apellido 2 -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input disabled type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo $objeto->getSegundoApellido() ?>">
            </div>
            <!-- fecha de nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input disabled type="date" class="form-control" id="fechaNac" name="fechaNac" value="<?php echo $objeto->getFechaNacimiento() ?>">
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input disabled type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $objeto->getTelefono() ?>">
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
                    <input disabled type="text" class="form-control" id="altura" name="altura" value="<?php echo $objeto->getAltura() ?>">
                </div>
                <!-- Posicion -->
                <div class="mb-3">
                    <label for="posicion" class="form-label">Posicion</label>
                    <select disabled class="form-select" id="posicion" name="posicion">
                        <option value="no especificado" <?php echo $objeto->getPosicion() == "no especificado" ? "selected" : "" ?>>No especificado</option>
                        <option value="Base"  <?php echo $objeto->getPosicion() == "Base" ? "selected" : "" ?>>Base</option>
                        <option value="Escolta"  <?php echo $objeto->getPosicion() == "Escolta" ? "selected" : "" ?>>Escolta</option>
                        <option value="Alero"  <?php echo $objeto->getPosicion() == "Alero" ? "selected" : "" ?>>Alero</option>
                        <option value="Ala-pivot" <?php echo $objeto->getPosicion() == "Ala-pivot" ? "selected" : "" ?>>Ala-pivot</option>
                        <option value="Pivot"  <?php echo $objeto->getPosicion() == "Pivot" ? "selected" : "" ?>>Pivot</option>
                    </select>
                </div>
                <!-- Extracomunitario -->
                <div class="mb-3">
                    <label for="extracomunitario" class="form-label">Extracomunitario</label>
                    <select disabled class="form-select" id="extracomunitario" name="extracomunitario">
                        <option value="no especificado" <?php echo $objeto->getExtracomunitario() == "no especificado" ? "selected" : "" ?>>No especificado</option>
                        <option value="si" <?php echo $objeto->getExtracomunitario() == "si" ? "selected" : "" ?>>Si</option>
                        <option value="no"  <?php echo $objeto->getExtracomunitario() == "no" ? "selected" : "" ?>>No</option>
                    </select>
                </div>
                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select disabled class="form-select" id="estado" name="estado">
                        <option value="no especificado" <?php echo $objeto->getEstado() == "no especificado" ? "selected" : "" ?>>No especificado</option>
                        <option value="disponible" <?php echo $objeto->getEstado() == "disponible" ? "selected" : "" ?>>Disponible</option>
                        <option value="fichado"  <?php echo $objeto->getEstado() == "fichado" ? "selected" : "" ?>>Fichado</option>
                    </select>
                </div>
                <!-- Equipo -->
                <div class="mb-3">
                    <label for="equipo" class="form-label">Equipo</label>
                    <input disabled type="text" class="form-control" id="equipo" name="equipo" value="<?php echo $objeto->getIdEquipo() ?>">
                </div>
                <!-- Biografia -->
                <div class="mb-3">
                    <label for="biografia" class="form-label">Biografia</label>
                    <textarea disabled id="biografia" name="biografia" name="biografia" class="form-control"><?php echo $objeto->getBiografia() ?></textarea>
                </div>
                <!-- Informe -->
                <div class="mb-3">
                    <label for="informe" class="form-label">Informe</label>
                    <textarea disabled id="informe" name="informe" name="informe" class="form-control"><?php echo $objeto->getInforme() ?></textarea>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
