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
<?php if ($jugadores != null) { ?>
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
            </td>
        </tr>
    <?php endforeach;
    } ?>
</table>
</main>
