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
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Visibilidad</th>
                    <th>Estado</th>
                    <th>Equipo</th>
                    <th>Posicion</th>
                    <th>Extracomunitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../model/dao/JugadorDAO.php';
                include_once '../model/entity/Jugador.php';
                foreach ($result as $jugador):
                    ?>
                    <tr class="jugador align-middle">
                        <td class="py-3">
                            <div class="row align-items-center w-100">
                                <div class="col-auto">
                                    <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>"><img src="<?php echo ".." . $jugador->getRuta() ?>" class="img-fluid rounded-circle" alt="<?php echo $jugador->getFullName() ?>" width="90"></a>
                                </div>
                                <div class="col-auto">
                                    <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>"><?php echo $jugador->getNombre() . " " . $jugador->getPrimerApellido() . " " . $jugador->getSegundoApellido() ?></a>

                                </div>
                            </div>
                        </td>
                        <td class="py-3"><?php echo $jugador->getVisible() == 1 ? 'Visible' : "Oculto" ?></td>
                        <td class="py-3"><?php
                            if ($jugador->getEstado() == 1) {
                                echo 'Disponible';
                            } else if ($jugador->getEstado() == 0) {
                                echo "Fichado";
                            } else {
                                "No especificado";
                            }
                            ?></td>
                        <td class="py-3"><?php echo $jugador->getEquipo() != "" ? $jugador->getEquipo() : "-" ?></td>
                        <td class="py-3"><?php echo ucfirst($jugador->getPosicion()) ?></td>
                        <td class="py-3"><?php
                            if ($jugador->getExtracomunitario() == 1) {
                                echo 'Si';
                            } else if ($jugador->getExtracomunitario() == 0) {
                                echo "No";
                            } else {
                                "No especificado";
                            }
                            ?></td>
                        <td class="py-3">
                            <a class="boton-menu mx-1" href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>">Ver</a>
                            <a class="boton-menu mx-1" href="?c=jugador&a=edit&id=<?php echo $jugador->getIdjugador() ?>">Editar</a>
                            <a class="boton-menu mx-1" href="#"  data-bs-toggle="modal" data-bs-target="#confirm-delete">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
</div>
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
                <a class="btn btn-danger btn-ok" href="?c=jugador&a=delete&id=<?php echo $jugador->getIdjugador() ?>">Eliminar</a>
            </div>
        </div>
    </div>
</div>
</main>