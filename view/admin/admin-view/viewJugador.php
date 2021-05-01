<?php include_once '../utility/Utilidades.php'; ?>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=jugador&a=list" class="boton-menu">Volver</a>
            <a href="?c=jugador&a=edit&id=<?php echo $_GET['id'] ?>" class="boton-menu">Editar</a>
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
    <!-- Nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input disabled type="text" class="form-control" id="nombre" value="<?php echo $jugador->getNombre() ?>">
    </div>
    <!-- Apellido 1 -->
    <div class="mb-3">
        <label for="apellido1" class="form-label">Primer apellido</label>
        <input disabled type="text" class="form-control" id="apellido1" value="<?php echo $jugador->getPrimerApellido() ?>">
    </div>
    <!-- Apellido 2 -->
    <div class="mb-3">
        <label for="apellido2" class="form-label">Segundo apellido</label>
        <input disabled type="text" class="form-control" id="apellido1" value="<?php echo $jugador->getSegundoApellido() ?>">
    </div>
    <!-- Altura -->
    <div class="mb-3">
        <label for="altura" class="form-label">Altura</label>
        <input disabled type="text" class="form-control" id="altura" value="<?php echo $jugador->getAltura() ?>">
    </div>
    <!-- Extracomunitario -->
    <div class="mb-3">
        <label for="extracomunitario" class="form-label">Extracomunitario</label>
        <select class="form-select" disabled>
            <option selected>Selecciona una opción</option>
            <option value="1" <?php echo $jugador->getExtracomunitario() == 1 ? "selected" : "" ?>>Si</option>
            <option value="0"  <?php echo $jugador->getExtracomunitario() == 0 ? "selected" : "" ?>>No</option>
        </select>
    </div>
    <!-- fecha de nacimiento -->
    <div class="mb-3">
        <label for="altura" class="form-label">Fecha de nacimiento</label>
        <input disabled type="date" class="form-control" id="altura" value="<?php echo $jugador->getFechaNacimiento() ?>">
    </div>
    <!-- Telefono -->
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input disabled type="tel" class="form-control" id="telefono" value="<?php echo $jugador->getTelefono() ?>">
    </div>
    <!-- Estado -->
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" disabled>
            <option selected>Selecciona una opción</option>
            <option value="disponible" <?php echo $jugador->getEstado() == "disponible" ? "selected" : "" ?>>Disponible</option>
            <option value="fichado"  <?php echo $jugador->getEstado() == "fichado" ? "selected" : "" ?>>Fichado</option>
        </select>
    </div>
    <!-- Biografia -->
    <div class="mb-3">
        <label for="biografia" class="form-label">Biografia</label>
        <textarea disabled="" id="biografia" name="biografia" class="form-control"><?php echo $jugador->getBiografia() ?></textarea>
    </div>
    <!-- Informe -->
    <div class="mb-3">
        <label for="informe" class="form-label">Informe</label>
        <textarea disabled="" id="biografia" name="biografia" class="form-control"><?php echo $jugador->getInforme() ?></textarea>
    </div>
    <!-- Equipo -->
    <div class="mb-3">
        <label for="equipo" class="form-label">Equipo</label>
        <input disabled type="text" class="form-control" id="equipo" value="<?php echo $jugador->getNombreEquipo() ?>">
    </div>
</form>
</div>
