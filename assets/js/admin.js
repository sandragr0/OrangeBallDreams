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
