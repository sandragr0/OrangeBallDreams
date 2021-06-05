<h1>Ver videos</h1>
<div class="col-12 mb-3">
    <div class="input-group">
        <span class="input-group-text" id="buscarNombre"><i class="fas fa-search"></i></span>
        <input type="text" class="form-control" id="inputBuscarNombre" placeholder="Buscar por nombre..."
               onkeyup="buscarJugador()"
               aria-describedby="buscarNombre">
    </div>
</div>
<div class="mb-3">
    <label for="jugador" class="form-label">Jugador<i id="search-icon"></i></label>
    <select class="form-select" id="jugador" name="jugador">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador->getIdJugador(); ?>">
                <?php echo $jugador->getFullName(); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<iframe onload="mostrarVideos()" class="d-none"></iframe>
<noscript>No se puede mostrar la información porque Javascript está desactivado en tu navegador</noscript>
<div id="panel_videos" class="table-responsive"></div>
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
                <a class="btn btn-danger btn-ok" id="link-eliminar"
                   href="#">Eliminar</a>
            </div>
        </div>
    </div>
</div>
</main>
