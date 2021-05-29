// Scripts generales (afectan a todas las páginas) ----------------------------------------------
// Mostrar tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// Functiones de utilidades ----------------------------------------------
function isEmpty(string) {
    if (string == "") {
    } else {
        return false;
    }
}

// Específico de la página login ----------------------------------------------
function visibilidadPass() {
    var ojo = document.getElementById("ojo");
    var input = document.getElementById("password");

    if (ojo.className == "fas fa-eye") {
        input.type = "text";
        ojo.classList.remove('fa-eye');
        ojo.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        ojo.classList.remove('fa-eye-slash');
        ojo.classList.add('fa-eye');
    }
}

function checkFormulario() {
    var usuario = document.getElementById("user").value;
    var password = document.getElementById("password").value;

    // Errores de comprobaciones en JS
    var error1 = document.getElementById("mensajeError1");
    var error2 = document.getElementById("mensajeError2");
    var error3 = document.getElementById("mensajeError3");

    // Errores de comprobaciones en PHP
    var error4 = document.getElementById("mensajeError4");
    var error5 = document.getElementById("mensajeError5");
    var error6 = document.getElementById("mensajeError6");

    // Ocultar los errores generados por php
    if (error4 != "undefined" && error4 != null) {
        error4.style.display = "none";
    }
    if (error5 != "undefined" && error5 != null) {
        error5.style.display = "none";
    }
    if (error6 != "undefined" && error6 != null) {
        error6.style.display = "none";
    }

    // Flag errores
    var errores = false;

    // Validar nombre de usuario
    if (isEmpty(usuario)) {
        error1.style.display = "block";
        error3.style.display = "none";
        errores = true;
    } else {
        error1.style.display = "none";
    }

    // Validar contraseña
    if (isEmpty(password)) {
        error2.style.display = "block";
        error3.style.display = "none";
        errores = true;
    } else {
        error2.style.display = "none";
    }

    // Comprobar si hay errores
    if (errores) {
        return false;
    } else {
        return true;
    }
}

// Específico de la página estadísticas ----------------------------------------------

function mostrarEstadisticas() {
    // Llamar por primera vez al cargar la página
    const id = $("select#jugadorList option:selected").val();
    getEstadisticas(id);

    // Llamar cada vez que se cambia de jugador
    $("select#jugadorList").change(function () {
        var id = $("select#jugadorList option:selected").val();
        getEstadisticas(id);
    });
}

function getEstadisticas(id) {
    fetch("http://localhost/OrangeBallDreams/assets/data/estadisticas.json")
        .then((resp) => resp.json()) // Transformar los datos a JSON
        .then(function (datos) {
                const datosFiltrados = $(datos).filter(function (datos, datoFiltrado) { // Filtrar el json
                    return datoFiltrado.idJugador === id
                });

                if (datosFiltrados.length != 0) {
                    let content = '<table class="table"><tr><th>Temporada</th><th>Liga</th><th>equipo</th> <th>PPP</th><th>APP</th><th>RPP</th><th>%2T</th><th>%3T</th><th>%TL</th><th>MIN</th><th>ROB</th><th>TAP</th><th>Acciones</th></tr>';
                    for (i = 0; i < datosFiltrados.length; i++) {
                        content +=
                            "<tr class='align-middle'>" +
                            "<td class='py-3'>" + datosFiltrados[i].temporada + "</td>" +
                            "<td>" + datosFiltrados[i].nombreLiga + "</td>" +
                            "<td>" + datosFiltrados[i].nombreEquipo + "</td>" +
                            "<td>" + datosFiltrados[i].PPP + "</td>" +
                            "<td>" + datosFiltrados[i].APP + "</td>" +
                            "<td>" + datosFiltrados[i].RPP + "</td>" +
                            "<td>" + datosFiltrados[i].porcentajeDobles + "</td>" +
                            "<td>" + datosFiltrados[i].porcentajeTriples + "</td>" +
                            "<td>" + datosFiltrados[i].porcentajeTL + "</td>" +
                            "<td>" + datosFiltrados[i].MIN + "</td>" +
                            "<td>" + datosFiltrados[i].ROB + "</td>" +
                            "<td>" + datosFiltrados[i].TAP + "</td>" +
                            "<td>" +
                            "<a href='?c=estadistica&a=edit&id=" + datosFiltrados[i].idEstadistica + "' class='boton-menu m-1 col-auto'>Editar</a>" +
                            "<a href=# data-bs-toggle='modal' data-bs-target='#confirm-delete' data-id='" + datosFiltrados[i].idEstadistica + "' class='boton-menu m-1 col-auto botonEliminarEstadistica'>Eliminar</a>" +
                            "</td>" +
                            "</tr>";
                    }
                    content += '</table>';
                    $("#panel_estadisticas").html(content);
                } else {
                    $("#panel_estadisticas").html("El jugador aún no tiene estadísticas. <a href='?c=estadistica&a=add'>¿Quieres añadir una estadística?</a>");
                }

            }
        );
}

// Específico de la página vídeos ----------------------------------------------

function mostrarVideos() {
    // Llamar por primera vez al cargar la página
    const id = $("select#jugadorList option:selected").val();
    getVideos(id);

    // Llamar cada vez que se cambia de jugador
    $("select#jugadorList").change(function () {
        var id = $("select#jugadorList option:selected").val();
        getVideos(id);
    });
}

function getVideos(id) {
    fetch("http://localhost/OrangeBallDreams/assets/data/videos.json")
        .then((resp) => resp.json()) // Transformar los datos a JSON
        .then(function (datos) {
                const datosFiltrados = $(datos).filter(function (datos, datoFiltrado) { // Filtrar el json
                    return datoFiltrado.idJugador === id
                });
                if (datosFiltrados.length != 0) {

                    let content = '<table class="table"><tr><th>Video</th></th><th>Visibilidad</th><th>Tipo de video</th><th>Acciones</th></tr>';
                    for (i = 0; i < datosFiltrados.length; i++) {
                        content +=
                            "<tr class='align-middle'>" +
                            "<td class='py-3 col-3'><iframe src='" + datosFiltrados[i].ruta + "'></iframe></td>" +
                            "<td>" + (datosFiltrados[i].isPublico == 1 ? "publico" : "privado") + "</td>" +
                            "<td>" + datosFiltrados[i].tipoVideo + "</td>" +
                            "<td>" +
                            "<a href=# data-bs-toggle='modal' data-bs-target='#confirm-delete' data-id='" + datosFiltrados[i].idVideo + "' class='boton-menu m-1 col-auto botonEliminarVideo'>Eliminar</a>" +
                            "</td>" +
                            "</tr>";
                    }
                    content += '</table>';
                    $("#panel_videos").html(content);
                } else {
                    $("#panel_videos").html("El jugador aún no tiene vídeos. <a href='?c=video&a=add'>¿Quieres añadir un video?</a>");
                }

            }
        );
}


// Botones borrar para los modales ----------------------------------------------

$(document).on("click", ".botonEliminarJugador", function () {
    const id = $(this).attr('data-id');
    $("#link-eliminar").attr("href", "?c=jugador&a=delete&id=" + id)
});

$(document).on("click", ".botonEliminarEstadistica", function () {
    const id = $(this).attr('data-id');
    $("#link-eliminar").attr("href", "?c=estadistica&a=delete&id=" + id)
});

$(document).on("click", ".botonEliminarEquipo", function () {
    const id = $(this).attr('data-id');
    $("#<link-eliminar>").attr("href", "?c=equipo&a=delete&id=" + id)
});

$(document).on("click", ".botonEliminarJugadorEquipo", function () {
    const idEquipo = $(this).attr('data-idequipo');
    const idJugador = $(this).attr('data-idjugador');
    $("#link-eliminar").attr("href", "?c=jugador&a=delete&id=" + idEquipo + "&a=deleteJugador&idJugador" + idJugador)
    $("#link-eliminar-dispo").attr("href", "?c=equipo&id" + idEquipo + "&a=deleteJugadorSetDispo&idJugador=" + idJugador)
});

$(document).on("click", ".botonEliminarVideo", function () {
    const id = $(this).attr('data-id');
    $("#link-eliminar").attr("href", "?c=video&a=delete&id=" + id)
});