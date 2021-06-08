<div class="container-fluid fondo-gradiente py-4 px-md-4 h-100">
    <main class="container bg-white shadow rounded py-4">
        <!-- Foto y datos principales -->
        <div class="row align-items-center">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-5">
                <img class="img-fluid rounded-circle shadow-sm" src="..<?php echo $jugador->getRuta() ?>">
            </div>
            <div class="col text-center text-md-start">
                <?php if ($jugador->getNacionalidades() != null) { ?>
                    <div class="row my-4">
                        <div class="col">
                            <?php foreach ($jugador->getNacionalidades() as $nacionalidad) { ?>
                                <img class="img-fluid" src="..<?php echo $nacionalidad->getIcono() ?>" width="40">
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-1">
                    <h1><?php echo $jugador->getFullName(); ?></h1>
                </div>
                <div class="row mb-2">
                    <span class="fs-4 text-capitalize"><?php echo $jugador->getEstado(); ?> / <?php echo $jugador->getPosicion(); ?></span>
                </div>
                <div class="row my-4">
                    <hr class="w-75 m-md-0 m-auto"/>
                </div>
                <div class="row">
                    <span class="fs-5"><span class="fw-bold">Género: </span> <?php echo $jugador->getGenero(); ?></span>
                </div>
                <div class="row">
                    <span class="fs-5"><span
                                class="fw-bold">Altura: </span> <?php echo $jugador->getAlturaCM(); ?></span>
                </div>
                <div class="row">
                    <span class="fs-5"><span
                                class="fw-bold">Año nacimiento: </span> <?php echo $jugador->getAñoNacimiento(); ?></span>
                </div>
            </div>
        </div>
        <!-- Datos jugador -->
        <div class="row p-4 mt-5">
            <div class="row my-2">
                <div class="col">
                    <h2>Biografia / Informe</h2>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col accordion accordion-flush p-0" id="datosJugador">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="biografia">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                Biografia
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                             aria-labelledby="biografia">
                            <div class="accordion-body">
                                <?php echo $jugador->getBiografia() != "" ? $jugador->getBiografia() : "-" ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="informe">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                Informe
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="informe">
                            <div class="accordion-body">
                                <?php echo $jugador->getInforme() != "" ? $jugador->getInforme() : "-" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <h2>Estadísticas</h2>
            </div>
            <div class="row">
                <?php if ($estadisticas != null) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Temporada</th>
                            <th>Liga</th>
                            <th>Equipo</th>
                            <th>PPP</th>
                            <th>APP</th>
                            <th>RPP</th>
                            <th>%2T</th>
                            <th>%3T</th>
                            <th>%TL</th>
                            <th>MIN</th>
                            <th>ROB</th>
                            <th>TAP</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($estadisticas as $estadistica) { ?>
                            <tr>
                                <td><?php echo $estadistica->getTemporada() ?></td>
                                <td><?php echo $estadistica->getNombreLiga() ?></td>
                                <td><?php echo $estadistica->getNombreEquipo() ?></td>
                                <td><?php echo $estadistica->getPPP() ?></td>
                                <td><?php echo $estadistica->getAPP() ?></td>
                                <td><?php echo $estadistica->getRPP() ?></td>
                                <td><?php echo $estadistica->getPorcentajeDobles() ?></td>
                                <td><?php echo $estadistica->getPorcentajeTriples() ?></td>
                                <td><?php echo $estadistica->getPorcentajeTL() ?></td>
                                <td><?php echo $estadistica->getMIN() ?></td>
                                <td><?php echo $estadistica->getROB() ?></td>
                                <td><?php echo $estadistica->getTAP() ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <small class="text-muted">PPP = puntos por partido | RPP = rebotes por partido | APP = asistencias por
                    partido |
                    MIN = minutos por partido | %2P = porcentaje de tiros de 2 | %3P = porcentaje de tiros de 3 | %TL =
                    porcentaje de tiros libres | ROB = robos | TAP = tapones<|small>
                    <?php } else { ?>
                        <p>Aún no tenemos estadísticas de este jugador</p>
                    <?php } ?>
                </small>
            </div>
        </div>
    </main>
</div>

<div class="container-fluid p-4">
    <div class="container p-4">
        <div class="row mb-4">
            <div class="col">
                <h2>Galeria de videos</h2>
            </div>
        </div>
        <?php if ($partidosCompletos != null) { ?>
            <div class="row mb-2">
                <div class="col">
                    <h3>Partidos completos</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">

                </div>
            </div>
        <?php } ?>
        <?php if ($highlights != null) { ?>
            <div class="row">
                <div class="col mb-2">
                    <h3>Highlights</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="position-absolute hide-video"></div>
                    </a>
                    <?php foreach ($highlights as $highlight) { ?>
                        <iframe width="360" height="215" src="<?php echo $highlight->getRuta() ?>" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                        <!-- Modal-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

