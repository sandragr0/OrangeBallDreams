<h1>Ver estadisticas</h1>
<div class="card">
    <div class="row mb-5">
        <div class="col-12">
            <div class="input-group mb-3">
                <span class="input-group-text" id="buscarNombre"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="inputBuscarNombre" placeholder="Buscar por nombre..."
                       onkeyup="buscarJugador()"
                       aria-describedby="buscarNombre">
            </div>
            <label for="jugador" class="form-label">Jugador<i id="search-icon"></i></label>
            <select class="form-select" id="jugador" name="jugador">
                <?php foreach ($jugadores as $jugador): ?>
                    <option value="<?php echo $jugador->getIdJugador(); ?>">
                        <?php echo $jugador->getFullName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <iframe onload="mostrarEstadisticas()" class="d-none"></iframe>
    <noscript>No se puede mostrar la información porque Javascript está desactivado en tu navegador</noscript>
    <div id="panel_estadisticas" class="table-responsive"></div>
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
                <a class="btn btn-danger btn-ok" id="link-eliminar"
                   href="?c=estadistica&a=delete&id=#">Eliminar</a>
            </div>
        </div>
    </div>
</div>
