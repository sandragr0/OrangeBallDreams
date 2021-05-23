<?php
?>
<div class="mb-4">
    <div class="row">
        <div class="col">
            <a href="?c=equipo&a=list" class="boton-menu">Volver</a>
            <a href="?c=equipo&a=edit&id=<?php echo $objeto->getIdEquipo() ?>" class="boton-menu">Editar</a>
        </div>
    </div>
</div>
<div class="mb-5">
    <div class="row">
        <div class="col">
            <h1 class="d-inline">Ver Equipo</h1>

        </div>
    </div>
</div>
<form class="mb-4">
    <!-- Nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label" data-toggle="tooltip" data-placement="top" title="Obligatorio">Nombre
            *</label>
        <input disabled type="text" class="form-control" id="nombre" name="nombre"
               value="<?php echo $objeto->getNombre() ?>">
    </div>
</form>
<!-- Jugadores -->
<?php
if ($jugadores != null) {
?>
<span>Jugadores</span>
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
                   data-bs-target="#confirm-delete">Quitar del equipo</a>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar?
                        Este cambio no se podrá deshacer
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok" href="?c=equipo&id=<?php echo $objeto->getIdEquipo() ?>&a=deleteJugador&idJugador=<?php echo $jugador->getIdjugador() ?>">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
    } ?>
</table>
</main>
