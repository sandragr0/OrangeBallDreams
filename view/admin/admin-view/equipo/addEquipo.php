<h1>Añadir equipo</h1>
<form method="post" action="?c=equipo&a=add">
    <?php
    if (isset($db_error)) {
        ?>
        <div class="card  border-danger mb-3">
            <div class="card-body">
                <?php
                if ($db_error == CodigosError::db_duplicate_entry) {
                    echo "Error. Ya existe un equipo con el mismo nombre.";
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
            <h2 class="card-title mb-4 fs-4">Datos del equipo</h2>
            <!-- Nombre -->
            <div class="mb-3 col-12 col-md-6">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>">
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
            <!-- Enviar -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary boton-orange">Añadir</button>
                <input type="reset" class="btn btn-secondary" value="Cancelar"></input>
                <div class="alert alert-danger mt-2 oculto" id="mensajeError" role="alert"></div>
            </div>
        </div>
    </div>
</form>
</main>