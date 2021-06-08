<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=contacto&a=list" class="boton-menu">Volver</a>
            <a href="?c=contacto&a=edit&id=<?php echo $objeto->getIdContacto(); ?>" class="boton-menu">Editar</a>
        </div>
    </div>
</div>
<div class="mb-5">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Ver contacto</h1>

        </div>
    </div>
</div>
<div class="card">
    <form class="row">
        <!-- Nombre -->
        <div class="mb-3 col-12 col-md-6">
            <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                *</label>
            <input disabled type="text" class="form-control" id="nombre" name="nombre"
                   value="<?php echo $objeto->getNombre(); ?>">
        </div>
        <!-- Apellido 1 -->
        <div class="mb-3 col-12 col-md-6">
            <label for="apellido1" class="form-label" data-toggle="tooltip" data-placement="top"
                   title="Obligatorio">Primer apellido *</label>
            <input disabled type="text" class="form-control" id="apellido1" name="apellido1"
                   value="<?php echo $objeto->getPrimerApellido(); ?>">
        </div>
        <!-- Apellido 2 -->
        <div class="mb-3 col-12 col-md-6">
            <label for="apellido2" class="form-label">Segundo apellido</label>
            <input disabled type="text" class="form-control" id="apellido2" name="apellido2"
                   value="<?php echo $objeto->getSegundoApellido(); ?>">
        </div>
        <!-- dni -->
        <div class="mb-3 col-12 col-md-6">
            <label for="nombre" class="form-label">DNI</label>
            <input disabled type="text" class="form-control" id="dni" name="dni"
                   value="<?php echo $objeto->getDni(); ?>">
        </div>
        <!-- Telefono -->
        <div class="mb-3 col-12 col-md-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input disabled type="tel" class="form-control" id="telefono" name="telefono"
                   value="<?php echo $objeto->getTelefono() ?>">
        </div>
        <!-- Equipo -->
        <div class="mb-3 col-12 col-md-6">
            <label for="equipo" class="form-label">Equipo</label>
            <input disabled type="text" class="form-control" id="equipo" name="equipo"
                   value="<?php echo $objeto->getEquipo() ?>">
        </div>
        <!-- Nota -->
        <div class="mb-3 col-12">
            <label for="nota" class="form-label">Nota</label>
            <textarea disabled id="nota" name="nota" name="nota"
                      class="form-control"><?php echo $objeto->getNota() ?></textarea>
        </div>
    </form>
</div>
</main>
