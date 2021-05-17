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
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../model/dao/JugadorDAO.php';
                include_once '../model/entity/Jugador.php';
                foreach ($result as $jugador):
                    ?>

                    <tr class="jugador">
                        <td>
                            <div class="row align-items-center w-100">
                                <div class="col-auto">
                                    <input type="checkbox"/>
                                </div>
                                <div class="col-auto">
                                    <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>"><?php echo $jugador->getNombre() . " " . $jugador->getPrimerApellido() . " " . $jugador->getSegundoApellido() ?></a> 
                                    <span class="d-block detalles mt-2">
                                        <a href="?c=jugador&a=view&id=<?php echo $jugador->getIdjugador() ?>">Ver</a> |
                                        <a href="?c=jugador&a=edit&id=<?php echo $jugador->getIdjugador() ?>">Editar</a> | 
                                        <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=jugador&a=delete&id=<?php echo $jugador->getIdjugador() ?>">Eliminar</a>
                                    </span>
                                </div>  </div>
                        </td>
                        <td><?php echo $jugador->getVisible() == 1 ? 'Visible' : "Oculto" ?></td>
                        <td><?php
                            if ($jugador->getEstado() == 1) {
                                echo 'Disponible';
                            } else if ($jugador->getEstado() == 0) {
                                echo "Fichado";
                            } else {
                                "No especificado";
                            }
                            ?></td>
                        <td><?php echo $jugador->getEquipo() != "" ? $jugador->getEquipo() : "-" ?></td> 
                        <td><?php echo ucfirst($jugador->getPosicion()) ?></td> 
                        <td><?php
                            if ($jugador->getExtracomunitario() == 1) {
                                echo 'Si';
                            } else if ($jugador->getExtracomunitario() == 0) {
                                echo "No";
                            } else {
                                "No especificado";
                            }
                            ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
</div>
</main>