<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=usuario&a=list" class="boton-menu">Volver</a>
            <a href="?c=usuario&a=edit&id=<?php echo $objeto->getIdUsuario(); ?>" class="boton-menu">Editar</a>
        </div>
    </div>
</div>
<div class="mb-5">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Ver usuario</h1>

        </div>
    </div>
</div>
<form>
    <!-- Datos del usuario -->
    <h2 class="card-title mb-4 fs-4">Datos del usuario</h2>
    <!-- Nombre del usuario -->
    <div class="mb-3">
        <label for="nombreUsuario" class="form-label" data-toggle="tooltip" data-placement="top"
               title="Obligatorio">Nombre de usuario *</label>
        <input disabled type="text" class="form-control" id="nombreUsuario" name="nombreUsuario"
               value="<?php echo $objeto->getNombreUsuario(); ?>">
    </div>
    <!-- Correo electrónico -->
    <div class="mb-3">
        <label for="correoElectronico" class="form-label" data-toggle="tooltip" data-placement="top"
               title="Obligatorio">Correo electrónico *</label>
        <input disabled type="text" class="form-control" id="correoElectronico" name="correoElectronico"
               value="<?php echo $objeto->getCorreoElectronico(); ?>">
    </div>
    <!-- Rol -->
    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select disabled class="form-select" id="rol" name="rol">
            <option value="usuario" <?php echo $objeto->getRol() == "usuario" ? "selected" : "" ?>>
                Usuario
            </option>
            <option value="administrador" <?php echo $objeto->getRol() == "administrador" ? "selected" : "" ?>>
                Administrador
            </option>
        </select>
    </div>

    <!-- Datos personales -->
    <h2 class="card-title mb-4 fs-4">Datos personales</h2>
    <!-- Nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
            *</label>
        <input disabled type="text" class="form-control" id="nombre" name="nombre"
               value="<?php echo $objeto->getNombre(); ?>">
    </div>
    <!-- Apellido 1 -->
    <div class="mb-3">
        <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top"
               title="Obligatorio">Primer apellido *</label>
        <input disabled type="text" class="form-control" id="apellido1" name="apellido1"
               value="<?php echo $objeto->getPrimerApellido(); ?>">
    </div>
    <!-- Apellido 2 -->
    <div class="mb-3">
        <label for="apellido2" class="form-label">Segundo apellido</label>
        <input disabled type="text" class="form-control" id="apellido2" name="apellido2"
               value="<?php echo $objeto->getSegundoApellido(); ?>">
    </div>
    <!-- dni -->
    <div class="mb-3">
        <label for="nombre" class="form-label">DNI</label>
        <input disabled type="text" class="form-control" id="dni" name="dni"
               value="<?php echo $objeto->getDni(); ?>">
    </div>
    <!-- Telefono -->
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input disabled type="tel" class="form-control" id="telefono" name="telefono"
               value="<?php echo $objeto->getTelefono() ?>">
    </div>
</form>

</main>
