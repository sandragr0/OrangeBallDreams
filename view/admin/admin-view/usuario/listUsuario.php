<h1>Ver usuarios</h1>
<?php
$result = $this->model->list();
if ($result == null) {
    ?>
    <div class="card mb-3">
        <div class="card-body">
            Aún no hay ningún usuario creado, <a href="?c=usuario&a=add">¿quieres añadir un nuevo usuario?</a>
        </div>
    </div>
    <?php
} else {
?>
<div class="input-group mb-3">
    <span class="input-group-text" id="buscarNombre"><i class="fas fa-search"></i></span>
    <input type="text" class="form-control" id="inputBuscarNombre" placeholder="Buscar por nombre..."
           onkeyup="buscarNombre('inputBuscarNombre', 'tabla_usuarios')" aria-describedby="buscarNombre">
</div>
<div class="table-responsive">
    <table class="table" id="tabla_usuarios">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nombre de usuario</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $usuario):
            ?>
            <tr class="align-middle">
                <td class="py-2"><?php echo $usuario->getIdUsuario() ?></td>
                <td class="py-2"><?php echo $usuario->getFullName() ?></td>
                <td class="py-2"><?php echo $usuario->getNombreUsuario() ?></td>
                <td class="py-2"><?php echo $usuario->getCorreoElectronico() ?></td>
                <!-- Acciones -->
                <td>
                    <div class="row w-100">
                        <a class="boton-menu m-1 col-auto"
                           href="?c=usuario&a=view&id=<?php echo $usuario->getIdUsuario() ?>">Ver</a>
                        <a class="boton-menu m-1 col-auto"
                           href="?c=usuario&a=edit&id=<?php echo $usuario->getIdUsuario() ?>">Editar</a>
                        <?php if ($usuario->getIdUsuario() != 1) { ?>
                            <a class="boton-menu m-1 col-auto botonEliminarUsuario"
                               data-id="<?php echo $usuario->getIdUsuario() ?>" href="#" data-bs-toggle="modal"
                               data-bs-target="#confirm-delete">Eliminar</a>
                            <?php } ?>
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
                <a class="btn btn-danger btn-ok" id="link-eliminar" href="#">Eliminar</a>
            </div>
        </div>
    </div>
</div>
</main>