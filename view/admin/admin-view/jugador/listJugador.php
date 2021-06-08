<h1>Ver jugadores</h1>
<?php
$result = $this->model->list();
if ($result == null) {
    ?>
    <div class="card mb-3">
        <div class="card-body">
            Aún no hay ningún jugador creado, <a href="?c=jugador&a=add">¿quieres añadir un nuevo jugador?</a>
        </div>
    </div>
    <?php
} else {
?>
<div class="input-group mb-3">
    <span class="input-group-text" id="buscarNombre"><i class="fas fa-search"></i></span>
    <input type="text" class="form-control" id="inputBuscarNombre" placeholder="Buscar por nombre..."
           onkeyup="buscarNombre('inputBuscarNombre', 'tabla_jugadores')" aria-describedby="buscarNombre">
</div>
<div class="table-responsive">
    <table class="table tablesorter-bootstrap" id="tabla_jugadores">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th data-sorter="false">Visibilidad</th>
            <th class="d-none d-md-table-cell" data-sorter="false">Estado</th>
            <th class="d-none d-md-table-cell" data-sorter="false">Equipo</th>
            <th class="d-none d-md-table-cell" data-sorter="false">Posicion</th>
            <th data-sorter="false">Acciones</th>
        </thead>
        <tbody>
        <?php
        foreach ($result as $jugador):
            ?>
            <tr class="jugador align-middle">
                <!-- idJugador -->
                <td class="py-2"><?php echo $jugador->getIdJugador() ?></td>
                <!-- nombre jugador -->
                <td>
                    <div class="row align-items-center w-100">
                        <div class="col-auto">
                            <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>"><img
                                        src="<?php echo ".." . $jugador->getRuta() ?>" class="img-fluid rounded-circle shadow-sm"
                                        alt="<?php echo $jugador->getFullName() ?>" width="90"></a>
                        </div>
                        <div class="col-auto">
                            <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>"><?php echo $jugador->getNombre() . " " . $jugador->getPrimerApellido() . " " . $jugador->getSegundoApellido() ?></a>

                        </div>
                    </div>
                </td>
                <!-- Visible -->
                <td><?php echo $jugador->getVisible() == 1 ? 'Visible' : "Oculto" ?></td>
                <!-- Estado -->
                <td class="d-none d-md-table-cell"><?php
                    if ($jugador->getEstado() == "disponible") {
                        echo 'Disponible';
                    } else if ($jugador->getEstado() == "fichado") {
                        echo "Fichado";
                    } else {
                        echo "No especificado";
                    }
                    ?></td>
                <!-- Equipo -->
                <td class="d-none d-md-table-cell"><?php echo $jugador->getEquipo() != "" ? $jugador->getEquipo() : "-" ?></td>
                <!-- Posición -->
                <td class="d-none d-md-table-cell"><?php echo ucfirst($jugador->getPosicion()) ?></td>
                <!-- Acciones -->
                <td>
                    <div class="row w-100">
                        <a class="boton-menu m-1 col-auto"
                           href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>">Ver</a>
                        <a class="boton-menu m-1 col-auto"
                           href="?c=jugador&a=edit&id=<?php echo $jugador->getIdjugador() ?>">Editar</a>
                        <a class="boton-menu m-1 col-auto botonEliminarJugador" href="#"
                           data-id="<?php echo $jugador->getIdjugador() ?>"
                           data-bs-toggle="modal"
                           data-bs-target="#confirm-delete">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php } ?>
</div>
<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
                <a class="btn btn-danger btn-ok" id="link-eliminar" href="?c=jugador&a=delete&id=#">Eliminar</a>
            </div>
        </div>
    </div>
</div>
</main>