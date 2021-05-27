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
        console.log("aqui");
        return false;
    } else {
        return true;
    }
}

function isEmpty(string) {
    if (string == "") {
        return true;
    } else {
        return false;
    }
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})


$(document).ready(function () {
    var id = $("select#jugador option:selected").val();
    getData(id);
    $("select#jugador").change(function () {
        var id = $("select#jugador option:selected").val();
        getData(id);
    });
});

function getData(id) {
    fetch("http://localhost/OrangeBallDreams/assets/estadisticas.json")
        .then((resp) => resp.json()) // Transform the data into json
        .then(function (data) {
                // Filtrar el json
                var filteredData = $(data).filter(function (i, n) {
                    return n.idJugador === id
                });
                if (filteredData.length != 0) {
                    var content = '<table class="table"><tr><th>Temporada</th><th>Liga</th><th>Equipo</th> <th>PPP</th><th>APP</th><th>RPP</th><th>%2T</th><th>%3T</th><th>%TL</th><th>MIN</th><th>ROB</th><th>TAP</th></tr>';
                    for (i = 0; i < filteredData.length; i++) {
                         content +=
                            "<tr>"+
                            "<td>" + filteredData[i].temporada + "</td>" +
                            "<td>" + filteredData[i].nombreLiga + "</td>" +
                            "<td>" + filteredData[i].nombreEquipo + "</td>" +
                            "<td>" + filteredData[i].PPP + "</td>" +
                            "<td>" + filteredData[i].APP + "</td>" +
                            "<td>" + filteredData[i].RPP + "</td>" +
                            "<td>" + filteredData[i].porcentajeDobles + "</td>" +
                            "<td>" + filteredData[i].porcentajeTriples + "</td>" +
                            "<td>" + filteredData[i].porcentajeTL + "</td>" +
                            "<td>" + filteredData[i].MIN + "</td>" +
                            "<td>" + filteredData[i].ROB + "</td>" +
                            "<td>" + filteredData[i].TAP + "</td>" +
                            "</tr>";
                    }
                    content +='</table>';
                    $("#panel_infoUsuario").html(content);
                } else {
                    $("#panel_infoUsuario").text("El jugador aún no tiene estadísticas");
                }

            }
        );

}