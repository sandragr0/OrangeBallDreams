<div class="container-fluid py-5 fondo">
    <div class="container" id="filtros">
        <div class="row justify-content-between mb-2">
            <div class="col-6">
                <p class="fw-bold fs-3"><em class="highlight">Filtrar por</em></p>
            </div>
            <div class="col-6 text-end">
                <a href="#" onclick="quitarFiltros()"><p class="fw-bold fs-1"><i class="fas fa-times"></i></p></a>
            </div>
        </div>
        <div class="row gx-5" onchange="filtrarJugador()">
            <!-- Filtrar por nombre -->
            <div class="col-12 col-md-3 mb-3 d-md-flex justify-content-start">
                <div>
                    <label class="form-label fw-bold titulo" for="inputBuscarNombre">Nombre</label>
                    <input type="text" class="form-control" id="inputBuscarNombre" onkeyup="filtrarJugador()"
                           placeholder="Buscar por nombre..." aria-describedby="buscarNombre">
                </div>
            </div>
            <!-- Filtrar por género -->
            <div class="col-12 col-md-2 mb-3 d-md-flex justify-content-center">
                <div id="generoCheckGroup">
                    <label class="form-label fw-bold titulo">Género</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="genero" id="femenino">
                        <label class="form-check-label" for="flexCheckDefault">
                            Femenino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="genero" id="masculino">
                        <label class="form-check-label" for="flexCheckDefault">
                            Masculino
                        </label>
                    </div>
                </div>
            </div>
            <!-- Filtrar por posicion -->
            <div class="col-12 col-md-3 mb-3 d-md-flex justify-content-center">
                <div>
                    <label class="form-label fw-bold titulo" for="inputBuscarNombre">Posición</label>
                    <div id="posicionCheckGroup">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posicion" id="Base">
                            <label class="form-check-label" for="flexCheckDefault">
                                Base
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posicion" id="Escolta">
                            <label class="form-check-label" for="flexCheckDefault">
                                Escolta
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posicion" id="Alero">
                            <label class="form-check-label" for="flexCheckDefault">
                                Alero
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posicion" id="Ala-pivot">
                            <label class="form-check-label" for="flexCheckDefault">
                                Ala-pivot
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="posicion" id="Pivot">
                            <label class="form-check-label" for="flexCheckDefault">
                                Pivot
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filtrar por extracomunitario -->
            <div class="col-12 col-md-2 mb-3 d-md-flex justify-content-center">
                <div id="extracomunitarioCheckGroup">
                    <label class="form-label fw-bold titulo" for="extracomunitario">Extracomunitario</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="extracomunitario" id="1">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Si
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="extracomunitario" id="0">
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <!-- Filtrar por disponibilidad -->
            <div class="col-12 col-md-2 mb-3 d-md-flex justify-content-end">
                <div id="disponibilidadCheckGroup">
                    <label class="form-label fw-bold titulo" for="disponible">Disponible</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disponible" id="disponible">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Si
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disponible" id="fichado">
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <main class="container pt-2" id="caja-jugadores">
        <div id="infoJugadores" class="mt-2 mb-4 row">
            <div class="col">
                <?php
                if ($jugadores != null) {
                    echo "Mostrando " . sizeof($jugadores) . " resultados";
                }
                ?>
            </div>
        </div>
        <div class="row jugadoresList gx-3 gy-4">
            <?php
            if ($jugadores != null) {
                foreach ($jugadores as $jugador):
                    ?>
                    <div class="col-12 col-md-4 col-xl-3 cardJugador"
                         data-nombre="<?php echo $jugador->getFullName() ?>"
                         data-genero="<?php echo $jugador->getGenero() ?>"
                         data-posicion="<?php echo $jugador->getPosicion() ?>"
                         data-extracomunitario="<?php echo $jugador->getExtracomunitario() ?>"
                         data-disponibilidad="<?php echo $jugador->getEstado() ?>"
                    >
                        <div class="card shadow-sm border-0 h-100">
                            <!-- Estado -->
                            <span class="badge position-absolute p-2 end-0 text-capitalize shadow-sm estadoPill <?php echo $jugador->getEstado() == "disponible" ? "bg-success" : "bg-danger" ?>">
                            <?php echo $jugador->getEstado(); ?>
                        </span>
                            <!-- Imagen -->
                            <img class="card-img-top <?php echo $jugador->getEstado() == "fichado" ? "fichado" : "" ?>"
                                 src="..<?php echo $jugador->getRuta() ?>" alt="Card image cap">
                            <!-- Contenido -->
                            <div class="card-body text-center">
                                <!-- Nombre -->
                                <h4 class="card-title text-uppercase">
                                    <a href="?a=verJugador?&id=<?php echo $jugador->getIdJugador() ?>"
                                       class="tituloLink stretched-link"><?php echo $jugador->getFullName() ?>
                                    </a>
                                </h4>
                                <!-- Nacionalidades -->
                                <?php
                                $nacionalidades = $jugador->getNacionalidades();
                                if (sizeof($nacionalidades) != 0) { ?>
                                    <div class="row gx-1 justify-content-center">
                                        <?php foreach ($nacionalidades as $nacionalidad): ?>
                                            <div class="col-auto">
                                                <img class="img-fluid" width="30"
                                                     title="<?php echo $nacionalidad->getNombre(); ?>"
                                                     src="../<?php echo $nacionalidad->getIcono() ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php } ?>
                                <!-- Características -->
                                <div class="row justify-content-center my-2">
                                    <div class="col-auto">
                                        <?php echo $jugador->getPosicion() ?>
                                    </div>
                                    <div class="col-auto border-start">
                                        <?php echo $jugador->getAlturaCM() ?>
                                    </div>
                                    <div class="col-auto border-start">
                                        <?php echo $jugador->getAñoNacimiento() ?>
                                    </div>
                                    <?php
                                    if ($jugador->getExtracomunitario() == 1) { ?>
                                        <div class="col-auto border-start">
                                            EXTRAC.
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            }
            ?>
        </div>
    </main>
</div>