<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=equipo&a=list" class="boton-menu">Volver</a>
        </div>
    </div>
</div>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Editar equipo</h1>
        </div>
    </div>
</div>
<form method="post" action="?c=equipo&a=edit&id=<?php echo $_GET["id"] ?>">
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title mb-4 fs-4">Datos del equipo</h2>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
                    *</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       value="<?php echo $objeto->getNombre() != "" ? $objeto->getNombre() : "" ?>">
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
<?php
if ($jugadores != null) {
?>
<div class="card mb-3">
    <div class="card-body">
        <h2 class="card-title mb-4 fs-4">Jugadores</h2>
        <table class="table mt-1">
            <thead>
            <th>Nombre</th>
            <th>Acción</th>
            </thead>
            <?php
            foreach ($jugadores as $jugador):
                ?>
                <tr class="align-middle">
                    <td class="py-3 col-4"><?php echo $jugador->getNombre() . " " . $jugador->getPrimerApellido() . " " . $jugador->getSegundoApellido(); ?></td>
                    <td>
                        <a target="_blank" class="boton-menu m-1 col-auto"
                           href="?c=jugador&a=view&id=<?php echo $jugador->getIdJugador() ?>">Ver</a>
                        <a target="_blank" class="boton-menu m-1 col-auto"
                           href="#" data-bs-toggle="modal"
                           data-bs-target="#confirm-delete-<?php echo $jugador->getIdJugador() ?>">Quitar del equipo</a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="confirm-delete-<?php echo $jugador->getIdJugador() ?>" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vas a quitar del equipo a <?php echo $jugador->getNombre() ?>, ¿quieres también ponerlo
                                como
                                estado disponible?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar
                                </button>
                                <a class="btn btn-danger btn-ok"
                                   href="?c=equipo&id=<?php echo $objeto->getIdEquipo() ?>&a=deleteJugador&idJugador=<?php echo $jugador->getIdjugador() ?>">Solo
                                    quitar del equipo</a>
                                <a class="btn btn-danger btn-ok"
                                   href="?c=equipo&id=<?php echo $objeto->getIdEquipo() ?>&a=deleteJugadorSetDispo&idJugador=<?php echo $jugador->getIdjugador() ?>">Quitar
                                    y establecer como disponible</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            } ?>
        </table>
    </div>
</div>
</main>