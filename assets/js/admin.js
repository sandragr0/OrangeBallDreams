// Scripts generales (afectan a todas las páginas) ----------------------------------------------
// Mostrar tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// Específico de la página login ----------------------------------------------
function visibilidadPass() {
    const ojo = document.getElementById("ojo");
    const input = document.getElementById("password");

    if (ojo.className === "fas fa-eye") {
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
    const usuario = document.getElementById("user").value;
    const password = document.getElementById("password").value;

    // Errores de comprobaciones en JS
    const error1 = document.getElementById("mensajeError1");
    const error2 = document.getElementById("mensajeError2");
    const error3 = document.getElementById("mensajeError3");

    // Errores de comprobaciones en PHP
    const error4 = document.getElementById("mensajeError4");
    const error5 = document.getElementById("mensajeError5");
    const error6 = document.getElementById("mensajeError6");

    // Ocultar los errores generados por php
    if (error4 !== "undefined" && error4 != null) {
        error4.style.display = "none";
    }
    if (error5 !== "undefined" && error5 != null) {
        error5.style.display = "none";
    }
    if (error6 !== "undefined" && error6 != null) {
        error6.style.display = "none";
    }

    // Flag errores
    let errores = false;

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
    return !errores;
}

// Específico de la página estadísticas ----------------------------------------------

function mostrarEstadisticas() {
    // Llamar por primera vez al cargar la página
    const id = $("select#jugador option:selected").val();
    getEstadisticas(id);

    // Llamar cada vez que se cambia de jugador
    $("select#jugador").change(function () {
        const id = $("select#jugador option:selected").val();
        getEstadisticas(id);
    });
}

function getEstadisticas(id) {
    fetch("https://orangeballdreams.com/assets/data/estadisticas.json", {mode: 'cors'})
        .then((resp) => resp.json()) // Transformar los datos a JSON
        .then(function (datos) {
                const datosFiltrados = $(datos).filter(function (datos, datoFiltrado) { // Filtrar el json
                    return datoFiltrado.idJugador === id
                });

                if (datosFiltrados.length !== 0) {
                    let content = '<table class="table"><thead><tr><th>Temporada</th><th>Liga</th><th>equipo</th> <th>PPP</th><th>APP</th><th>RPP</th><th>%2T</th><th>%3T</th><th>%TL</th><th>MIN</th><th>ROB</th><th>TAP</th><th>Acciones</th></tr></thead><tbody>';
                    for (let i = 0; i < datosFiltrados.length; i++) {
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
                    content += '</tbody></table>';
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
    const id = $("select#jugador option:selected").val();
    getVideos(id);

    // Llamar cada vez que se cambia de jugador
    $("select#jugador").change(function () {
        const id = $("select#jugador option:selected").val();
        getVideos(id);
    });
}

function getVideos(id) {
    fetch("https://orangeballdreams.com/assets/data/videos.json", {mode: 'cors'})
        .then((resp) => resp.json()) // Transformar los datos a JSON
        .then(function (datos) {
                const datosFiltrados = $(datos).filter(function (datos, datoFiltrado) { // Filtrar el json
                    return datoFiltrado.idJugador === id
                });
                if (datosFiltrados.length !== 0) {
                    let content = '<table class="table"><thead><tr><th>Video</th></th><th>Visibilidad</th><th>Tipo de video</th><th>Acciones</th></tr></thead><tbody>';
                    for (let i = 0; i < datosFiltrados.length; i++) {
                        content +=
                            "<tr class='align-middle'>" +
                            "<td class='py-3 col-3'><iframe src='" + datosFiltrados[i].ruta + "'></iframe></td>" +
                            "<td>" + (datosFiltrados[i].isPublico == 1 ? "publico" : "privado") + "</td>" +
                            "<td>" + datosFiltrados[i].tipoVideo + "</td>" +
                            "<td>" +
                            "<a href='?c=video&a=edit&id=" + datosFiltrados[i].idVideo + "' class='boton-menu m-1 col-auto'>Editar</a>" +
                            "<a href=# data-bs-toggle='modal' data-bs-target='#confirm-delete' data-id='" + datosFiltrados[i].idVideo + "' class='boton-menu m-1 col-auto botonEliminarVideo'>Eliminar</a>" +
                            "</td>" +
                            "</tr>";
                    }
                    content += '</tbody></table>';
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
    $("#link-eliminar").attr("href", "?c=equipo&a=delete&id=" + id)
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

$(document).on("click", ".botonEliminarContacto", function () {
    const id = $(this).attr('data-id');
    $("#link-eliminar").attr("href", "?c=contacto&a=delete&id=" + id)
});

$(document).on("click", ".botonEliminarUsuario", function () {
    const id = $(this).attr('data-id');
    $("#link-eliminar").attr("href", "?c=usuario&a=delete&id=" + id)
});

// Funciones de búsqueda y filtros ----------------------------------------------

// Filtrar tablas
$(function () {
    $("#tabla_jugadores").tablesorter({sortList: [[0, 0]]})
});

// Ordenar tablas
function buscarNombre(input, tabla) {
    // Declarar variables
    let filter = input.value.toUpperCase();
    let table = document.getElementById(tabla);
    let tr = table.getElementsByTagName("tr");

    // Bucle por cada tr, oculta los tr que no cumplan la condición
    let td;
    let txtValue;
    for (let i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Filtrar nacionalidades
function filtrarNacionalidades() {
    // Declare variables
    const inputBuscar = document.getElementById("filtroNacionalidades");
    const textoFiltro = inputBuscar.value.toUpperCase();
    const cajaCheckbox = $("div#caja-nacionalidades div.form-check");

    // Loop through all table rows, and hide those who don't match the search query
    let txtValue;
    for (let i = 0; i < cajaCheckbox.length; i++) {
        txtValue = $(cajaCheckbox[i]).data('id');
        if (txtValue.toUpperCase().indexOf(textoFiltro) > -1) {
            cajaCheckbox[i].style.display = "";
        } else {
            cajaCheckbox[i].style.display = "none";
        }
    }
}

// Filtrar jugadores en los select
function buscarJugador() {
    const selectJugadores = document.getElementById("jugador");
    const input = document.getElementById("inputBuscarNombre");
    const filter = input.value.toUpperCase();
    const option = selectJugadores.getElementsByTagName("option");
    const searchIcon = document.getElementById("search-icon");

    let encontrado = false;
    let txtValue;
    for (let i = 0; i < option.length; i++) {
        searchIcon.classList.add("ms-2", "fas", "fa-spinner", "fa-pulse");
        if (option[i]) {
            txtValue = option[i].textContent || option[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                encontrado = true;
                option[i].style.display = "";
            } else {
                option[i].style.display = "none";
            }
        }
    }

    if (filter !== "") {
        if (encontrado === true) {
            searchIcon.classList.remove("fas", "fa-spinner", "fa-pulse");
            searchIcon.classList.add("ms-2", "fas", "fa-check-circle");
        } else {
            searchIcon.classList.remove("fas", "fa-spinner", "fa-pulse");
            searchIcon.classList.add("ms-2", "fas", "fa-exclamation-circle");
        }
    } else {
        searchIcon.className = "";
    }

}

// Functiones de validacion  ----------------------------------------------

function isEmpty(value) {
    return value === "";
}

function isString(value) {
    return /(^[A-Za-zñÑá-úÁ-Ú]+$)/.test(value);

}

function isStringWithWhiteSpaces(value) {
    return /(^[A-Za-zñÑá-úÁ-Ú\s]+$)/.test(value);

}

function isDni(value) {
    return /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke]$/.test(value);

}

function isFecha(value) {
    return /^([0-9]{4})(-)([0-9]{2})(-)([0-9]{2})$/.test(value);

}

function isTelefono(value) {
    return /(^[0-9]{9}$)/.test(value);

}

function isAltura(value) {
    return /(^[0-9].[0-9]{2}$)/.test(value);

}

function isAlphanumeric(value) {
    return /(^[A-Za-zñÑá-úÁ-Ú0-9\s]+$)/.test(value);
}

function isTemporada(value) {
    return /^[0-9]{2}[-][0-9]{2}$/.test(value);
}

function isAlpha(value) {
    return /(^[A-Za-zñÑá-úÁ-Ú0-9\s]+$)/.test(value);
}

function isNumeroValidoHastaDosCifras(value) {
    return /^[0-9]{1,2}$/.test(value);
}

function isDecimalHastaDosCifras(value) {
    return /^[0-9]{1,2}[.][0-9]$/.test(value);
}

function isNumeroValidoHastaTresCifras(value) {
    return /^[0-9]{1,3}$/.test(value);
}

function isRuta(value) {
    return /^http.*youtube.com.*(embed).+$/.test(value);
}

function isUsuario(value) {
    return /[a-zA-Z0-9]{6,12}/.test(value);
}

function isCorreoElectronico(value) {
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(value);
}

function isContraseña(value) {
    return /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(value);
}

// Validar formularios backoffice ----------------------------------------------

// Añadir/editar jugador ---------------

function validarFormJugador() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const nombre = document.getElementById("nombre").value;
    const apellido1 = document.getElementById("apellido1").value;
    const apellido2 = document.getElementById("apellido2").value;
    const dni = document.getElementById("dni").value;
    const fechaNac = document.getElementById("fechaNac").value;
    const telefono = document.getElementById("telefono").value;
    const altura = document.getElementById("altura").value;
    const equipo = document.getElementById("equipo").value;

    // Variables de errores
    let isErrorNombre = true;
    let isErrorApellido1 = true;
    let isErrorApellido2 = true;
    let isErrorDni = true;
    let isErrorFechaNac = true;
    let isErrorTelefono = true;
    let isErrorAltura = true;
    let isErrorEquipo = true;

    if (isValidoNombre(nombre)) {
        isErrorNombre = false;
    }
    if (isValidoPrimerApellido(apellido1)) {
        isErrorApellido1 = false;
    }
    if (isValidoSegundoApellido(apellido2)) {
        isErrorApellido2 = false;
    }
    if (isValidoDni(dni)) {
        isErrorDni = false;
    }
    if (isValidoFechaNac(fechaNac)) {
        isErrorFechaNac = false;
    }
    if (isValidoTelefono(telefono)) {
        isErrorTelefono = false;
    }
    if (isValidoAltura(altura)) {
        isErrorAltura = false;
    }
    if (isValidoEquipo(equipo)) {
        isErrorEquipo = false;
    }

    return !isErrorNombre && !isErrorApellido1 && !isErrorApellido2 && !isErrorDni && !isErrorFechaNac && !isErrorTelefono && !isErrorAltura && !isErrorEquipo;
}

function isValidoNombre(value) {
    if (isEmpty(value)) {
        $("div#errorNombreEmpty").removeClass("d-none");
        return false;
    }
    if (!isStringWithWhiteSpaces(value)) {
        $("div#errorNombreInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorNombreEmpty").addClass("d-none");
    $("div#errorNombreEmpty").addClass("d-none");
    return true;
}


function isValidoPrimerApellido(value) {
    if (isEmpty(value)) {
        $("div#errorApellido1Empty").removeClass("d-none");
        return false;
    }
    if (!isStringWithWhiteSpaces(value)) {
        $("div#errorApellido1Invalid").removeClass("d-none");
        return false;
    }
    $("div#errorApellido1Empty").addClass("d-none");
    $("div#errorApellido1Invalid").addClass("d-none");
    return true;
}

function isValidoSegundoApellido(value) {
    if (!isEmpty(value)) {
        if (!isStringWithWhiteSpaces(value)) {
            $("div#errorApellido2Invalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorApellido2Empty").addClass("d-none");
    return true;
}

function isValidoDni(value) {
    if (!isEmpty(value)) {
        if (!isDni(value)) {
            $("div#errorDniInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorDniInvalid").addClass("d-none");
    return true;
}

function isValidoFechaNac(value) {
    if (isEmpty(value)) {
        $("div#errorFechaNacEmpty").removeClass("d-none");
        return false;
    }
    if (!isFecha(value)) {
        $("div#errorFechaNacInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorFechaNacEmpty").addClass("d-none");
    $("div#errorFechaNacInvalid").addClass("d-none");
    return true;
}

function isValidoTelefono(value) {
    if (!isEmpty(value)) {
        if (!isTelefono(value)) {
            $("div#errorTelefonoInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorTelefonoInvalid").addClass("d-none");
    return true;
}


function isValidoAltura(value) {
    if (isEmpty(value)) {
        $("div#errorAlturaEmpty").removeClass("d-none");
        return false;
    }
    if (!isAltura(value)) {
        $("div#errorAlturaInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorAlturaEmpty").addClass("d-none");
    $("div#errorAlturaInvalid").addClass("d-none");
    return true;
}

function isValidoEquipo(value) {
    if (!isEmpty(value)) {
        if (!isAlphanumeric(value)) {
            $("div#errorEquipoInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorEquipoInvalid").addClass("d-none");
    return true;
}

// Añadir/editar estadistica ---------------


function validarFormEstadistica() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const temporada = document.getElementById("temporada").value;
    const nombre = document.getElementById("nombreEquipo").value;
    const liga = document.getElementById("nombreLiga").value;
    const ppp = document.getElementById("PPP").value;
    const app = document.getElementById("APP").value;
    const rpp = document.getElementById("RPP").value;
    const porcentajeDobles = document.getElementById("porcentajeDobles").value;
    const porcentajeTriples = document.getElementById("porcentajeTriples").value;
    const porcentajeTL = document.getElementById("porcentajeTL").value;
    const tap = document.getElementById("TAP").value;
    const rob = document.getElementById("ROB").value;
    const min = document.getElementById("MIN").value;

    // Variables de errores
    let isErrorTemporada = true;
    let isErrorNombre = true;
    let isErrorLiga = true;
    let isErrorPPP = true;
    let isErrorAPP = true;
    let isErrorRPP = true;
    let isErrorPorcentajeDobles = true;
    let isErrorPorcentajeTriples = true;
    let isErrorPorcentajeTL = true;
    let isErrorTAP = true;
    let isErrorROB = true;
    let isErrorMIN = true;

    if (isValidoTemporada(temporada)) {
        isErrorTemporada = false;
    }
    if (isValidoNombreEquipo(nombre)) {
        isErrorNombre = false;
    }
    if (isValidoLiga(liga)) {
        isErrorLiga = false;
    }
    if (isValidoPPP(ppp)) {
        isErrorPPP = false;
    }
    if (isValidoAPP(app)) {
        isErrorAPP = false;
    }
    if (isValidoRPP(rpp)) {
        isErrorRPP = false;
    }
    if (isValidoPorcentajeDobles(porcentajeDobles)) {
        isErrorPorcentajeDobles = false;
    }
    if (isValidoPorcentajeTriples(porcentajeTriples)) {
        isErrorPorcentajeTriples = false;
    }
    if (isValidoPorcentajeTL(porcentajeTL)) {
        isErrorPorcentajeTL = false;
    }
    if (isValidoTAP(tap)) {
        isErrorTAP = false;
    }
    if (isValidoROB(rob)) {
        isErrorROB = false;
    }
    if (isValidoMIN(min)) {
        isErrorMIN = false;
    }


    return !isErrorTemporada && !isErrorNombre && !isErrorLiga && !isErrorPPP && !isErrorAPP && !isErrorRPP && !isErrorPorcentajeDobles && !isErrorPorcentajeTriples && !isErrorPorcentajeTL && !isErrorTAP && !isErrorROB && !isErrorMIN;
}

function isValidoNombreEquipo(value) {
    if (isEmpty(value)) {
        $("div#errorNombreEmpty").removeClass("d-none");
        return false;
    }
    if (!isAlpha(value)) {
        $("div#errorNombreInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorNombreEmpty").addClass("d-none");
    $("div#errorNombreEmpty").addClass("d-none");
    return true;
}


function isValidoTemporada(value) {
    if (isEmpty(value)) {
        $("div#errorTemporadaEmpty").removeClass("d-none");
        return false;
    }
    if (!isTemporada(value)) {
        $("div#errorTemporadaInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorTemporadaEmpty").addClass("d-none");
    $("div#errorTemporadaInvalid").addClass("d-none");
    return true;
}

function isValidoLiga(value) {
    if (isEmpty(value)) {
        $("div#errorLigaEmpty").removeClass("d-none");
        return false;
    }
    if (!isAlpha(value)) {
        $("div#errorLigaInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorLigaEmpty").addClass("d-none");
    $("div#errorLigaInvalid").addClass("d-none");
    return true;
}

function isValidoPPP(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorPPPInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorPPPInvalid").addClass("d-none");
    return true;
}

function isValidoAPP(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorAPPInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorAPPInvalid").addClass("d-none");
    return true;
}

function isValidoRPP(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorRPPInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorRPPInvalid").addClass("d-none");
    return true;
}

function isValidoPorcentajeDobles(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaTresCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorPorcentajeTirosDoblesInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorPorcentajeTirosDoblesInvalid").addClass("d-none");
    return true;
}

function isValidoPorcentajeTriples(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaTresCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorPorcentajeTirosTriplesInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorPorcentajeTirosTriplesInvalid").addClass("d-none");
    return true;
}

function isValidoPorcentajeTL(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaTresCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorPorcentajeTirosLibresInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorPorcentajeTirosLibresInvalid").addClass("d-none");
    return true;
}

function isValidoTAP(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorTAPInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorTAPInvalid").addClass("d-none");
    return true;
}

function isValidoROB(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorROBInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorROBInvalid").addClass("d-none");
    return true;
}

function isValidoMIN(value) {
    if (!isEmpty(value)) {
        if (!isNumeroValidoHastaDosCifras(value) && !isDecimalHastaDosCifras(value)) {
            $("div#errorMINInvalid").removeClass("d-none");
            return false;
        }
    }
    $("div#errorMINInvalid").addClass("d-none");
    return true;
}

// Añadir/editar video ---------------
function validarFormVideo() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const ruta = document.getElementById("ruta").value;

    // Variables de errores
    let isErrorRuta = true;


    if (isValidoRuta(ruta)) {
        isErrorRuta = false;
    }

    return !isErrorRuta;
}

function isValidoRuta(value) {
    if (isEmpty(value)) {
        $("div#errorRutaEmpty").removeClass("d-none");
        return false;
    }
    if (!isRuta(value)) {
        $("div#errorRutaInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorRutaEmpty").addClass("d-none");
    $("div#errorRutaInvalid").addClass("d-none");
    return true;
}

// Añadir/editar equipo ---------------

function validarFormEquipo() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const nombre = document.getElementById("nombre").value;

    // Variables de errores
    let isErrorNombre = true;

    if (isValidoNombreEquipo(nombre)) {
        isErrorNombre = false;
    }

    return !isErrorNombre;
}

// Añadir/editar Contacto ---------------
function validarFormContacto() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const nombre = document.getElementById("nombre").value;
    const apellido1 = document.getElementById("apellido1").value;
    const apellido2 = document.getElementById("apellido2").value;
    const dni = document.getElementById("dni").value;
    const telefono = document.getElementById("telefono").value;
    const equipo = document.getElementById("equipo").value;

    // Variables de errores
    let isErrorNombre = true;
    let isErrorApellido1 = true;
    let isErrorApellido2 = true;
    let isErrorDni = true;
    let isErrorTelefono = true;
    let isErrorEquipo = true;

    if (isValidoNombre(nombre)) {
        isErrorNombre = false;
    }
    if (isValidoPrimerApellido(apellido1)) {
        isErrorApellido1 = false;
    }
    if (isValidoSegundoApellido(apellido2)) {
        isErrorApellido2 = false;
    }
    if (isValidoDni(dni)) {
        isErrorDni = false;
    }
    if (isValidoTelefono(telefono)) {
        isErrorTelefono = false;
    }
    if (isValidoEquipo(equipo)) {
        isErrorEquipo = false;
    }

    return !isErrorNombre && !isErrorApellido1 && !isErrorApellido2 && !isErrorDni && !isErrorTelefono && !isErrorEquipo;
}

// Añadir/editar Usuario ---------------


function validarFormUsuario() {

    // Ocultar errores de PHP si hubieran
    $(".error").addClass("d-none");

    // Variables con los valores de los input
    const nombreUsuario = document.getElementById("nombreUsuario").value;
    const correoElectronico = document.getElementById("correoElectronico").value;
    const contraseña = document.getElementById("contraseña").value;
    const nombre = document.getElementById("nombre").value;
    const apellido1 = document.getElementById("apellido1").value;
    const apellido2 = document.getElementById("apellido2").value;
    const dni = document.getElementById("dni").value;
    const telefono = document.getElementById("telefono").value;


    // Variables de errores
    let isErrorNombreUsuario = true;
    let isErrorCorreoElectronico = true;
    let isErrorContraseña = true;
    let isErrorNombre = true;
    let isErrorApellido1 = true;
    let isErrorApellido2 = true;
    let isErrorDni = true;
    let isErrorTelefono = true;

    if (isValidoNombreUsuario(nombreUsuario)) {
        isErrorNombreUsuario = false;
    }
    if (isValidoCorreoElectronico(correoElectronico)) {
        isErrorContraseña = false;
    }
    if (isValidoContraseña(contraseña)) {
        isErrorNombre = false;
    }
    if (isValidoNombre(nombre)) {
        isErrorNombre = false;
    }
    if (isValidoPrimerApellido(apellido1)) {
        isErrorApellido1 = false;
    }
    if (isValidoSegundoApellido(apellido2)) {
        isErrorApellido2 = false;
    }
    if (isValidoDni(dni)) {
        isErrorDni = false;
    }
    if (isValidoTelefono(telefono)) {
        isErrorTelefono = false;
    }

    return !isErrorNombreUsuario && !isErrorCorreoElectronico && !isErrorContraseña && !isErrorNombre && !isErrorApellido1 && !isErrorApellido2 && !isErrorDni && !isErrorTelefono;
}


function isValidoNombreUsuario(value) {
    if (isEmpty(value)) {
        $("div#errorUsuarioEmpty").removeClass("d-none");
        return false;
    }
    if (!isUsuario(value)) {
        $("div#errorUsuarioInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorUsuarioEmpty").addClass("d-none");
    $("div#errorUsuarioInvalid").addClass("d-none");
    return true;
}

function isValidoCorreoElectronico(value) {
    if (isEmpty(value)) {
        $("div#errorEmailEmpty").removeClass("d-none");
        return false;
    }
    if (!isCorreoElectronico(value)) {
        $("div#errorEmailInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorEmailEmpty").addClass("d-none");
    $("div#errorEmailInvalid").addClass("d-none");
    return true;
}

function isValidoContraseña(value) {
    if (isEmpty(value)) {
        $("div#errorPassEmpty").removeClass("d-none");
        return false;
    }
    if (!isContraseña(value)) {
        $("div#errorPassInvalid").removeClass("d-none");
        return false;
    }
    $("div#errorPassEmpty").addClass("d-none");
    $("div#errorPassInvalid").addClass("d-none");
    return true;
}