<h1>Ver jugadores</h1>
<div class="table-responsive table-striped">
    <table  class="table">
        <tr>     
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Estado</th>
        </tr>
        <?php
        include_once '../model/dao/JugadorDAO.php';
        include_once '../model/entity/Jugador.php';
        $r = new Jugador();
        foreach ($this->model->list() as $r):
            ?>
            <tr class="jugador">
                <td><a href="?c=jugador&a=view&id=<?php echo $r->getIdjugador() ?>"><?php echo $r->getNombre() . " " . $r->getPrimerApellido() . " " . $r->getSegundoApellido()  ?></a> 
                    <span class="d-block detalles mt-2">
                    <span>ID: <?php echo $r->getIdjugador()?></span> |
                    <a href="?c=jugador&a=view&id=<?php echo $r->getIdjugador() ?>">Ver</a> |
                    <a href="?c=jugador&a=edit&id=<?php echo $r->getIdjugador() ?>">Editar</a>
                    </span>
                </td>
                <td><?php echo $r->getTelefono() ?></td>
                <td><?php echo $r->getEstado() ?></td>    
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</main>