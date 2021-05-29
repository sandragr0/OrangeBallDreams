<h1>Ver equipos</h1>
<?php
$result = $this->model->list();
if ($result == null) {
    ?>
    <div class="card mb-3">
        <div class="card-body">
            Aún no hay ningún equipo creado, <a href="?c=equipo&a=add">¿quieres añadir un nuevo equipo?</a>
        </div>
    </div>
    <?php
} else {
?>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $equipo):
            ?>
            <tr class="align-middle">
                <td class="py-2"><?php echo $equipo->getNombre() ?></td>
                <!-- Acciones -->
                <td>
                    <div class="row w-100">
                        <a class="boton-menu m-1 col-auto"
                           href="?c=equipo&a=view&id=<?php echo $equipo->getIdEquipo() ?>">Ver</a>
                        <a class="boton-menu m-1 col-auto"
                           href="?c=equipo&a=edit&id=<?php echo $equipo->getIdEquipo() ?>">Editar</a>
                        <a class="boton-menu m-1 col-auto botonEliminarEquipo" data-id="<?php echo $equipo->getIdEquipo() ?>" href="#" data-bs-toggle="modal"
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
                <a class="btn btn-danger btn-ok" id="link-eliminar" href="?c=equipo&a=delete&id=#">Eliminar</a>
            </div>
        </div>
    </div>
</div>
</main>