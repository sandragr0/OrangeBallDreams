<div class="container">

</div>
<main class="container my-5">
    <div class="row gx-3">
        <?php
        if ($jugadores != null) {
            foreach ($jugadores as $jugador):
                ?>
                <div class="col-3">
                    <div class="card">
                        <img class="card-img-top" src="..<?php echo $jugador->getRuta() ?>" alt="Card image cap">
                        <div class="card-body text-center">
                            <div class="nacionalidades">
                                <?php
                                $nacionalidades = $jugador->getNacionalidades();
                                if (sizeof($nacionalidades) != 0) { ?>
                                    <?php foreach ($nacionalidades as $nacionalidad): ?>
                                        <img height="30" src="../<?php echo $nacionalidad->getIcono() ?>">
                                    <?php endforeach; ?>

                                <?php } ?>
                            </div>
                            <h4 class="card-title text-uppercase"><a href="#"
                                                                     class="tituloLink"><?php echo $jugador->getFullName() ?></a>
                            </h4>
                            <div><?php echo $jugador->getPosicion() != "No especificado" ? $jugador->getPosicion() : "-"  ?> | <?php echo $jugador->getAlturaCM() != "" ? $jugador->getAlturaCM() : "-"  ?> | <?php echo $jugador->getAñoNacimiento() != "" ? $jugador->getAñoNacimiento() : "-"  ?> | <?php echo $jugador->getEstado() ?></div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        }
        ?>
    </div>
</main>