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
    var error1 = document.getElementById("mensajeError1");
    var error2 = document.getElementById("mensajeError2");
    var error3 = document.getElementById("mensajeError3");

    // Flag errores
    var errores = false;

    // Validar nombre de usuario
    if (isEmpty(usuario)) {
        error1.style.display = "block";
        errores = true;
    } else {
        error1.style.display = "none";
    }

    // Validar contraseña
    if (isEmpty(password)) {
        error2.style.display = "block";
        errores = true;
    } else {
        error2.style.display = "none";
    }

    // Comprobar si hay errores
    if (errores) {
        return false;
    } else {
        // El limite en la BD es 20 carácteres. Para no saturar el servidor comprobamos ya desde JS que los usuarios con mas carácteres son incorrectos.
        if (usuario.length > 20) {
            error3.style.display = "block";
            return false;
        } else {
            return true;
        }
    }
}

function isEmpty(string) {
    if (string == "") {
        return true;
    } else {
        return false;
    }
}
