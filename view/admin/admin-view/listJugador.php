<h1>Ver jugadores</h1>
<div class="table-responsive">
    <table  class="table">
        <tr>     
            <th>Ver</th>
            <th>Editar</th>
            <th>Nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
            <th>Telefono</th>
            <th>Estado</th>
        </tr>
        <?php
        include_once '../model/dao/JugadorDAO.php';
        include_once '../model/entity/Jugador.php';
        $r = new Jugador();
        foreach ($this->model->list() as $r):
            ?>
            <tr>
                <td><a href="?c=jugador&a=view&id=<?php echo $r->getIdjugador() ?>"><i class="fas fa-search"></i></a></td>
                <td><a href="?c=jugador&a=edit&id=<?php echo $r->getIdjugador() ?>"><i class="fas fa-edit"></i></a></td>
                <td><?php echo $r->getNombre() ?></td>
                <td><?php echo $r->getPrimerApellido() ?></td>
                <td><?php echo $r->getSegundoApellido() ?></td>
                <td><?php echo $r->getTelefono() ?></td>
                <td><?php echo $r->getEstado() ?></td>    
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</main>