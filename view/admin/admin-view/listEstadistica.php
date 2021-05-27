<h1>Ver estadisticas</h1>
<div class="mb-3">
    <label for="jugador" class="form-label">Jugador</label>
    <select class="form-select" id="jugador" name="jugador">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador->getIdJugador(); ?>">
                <?php echo $jugador->getFullName(); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<div id="panel_infoUsuario" class="table-responsive"></div>