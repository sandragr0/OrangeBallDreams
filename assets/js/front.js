// Logo ----------------------------------------------
$(function () {
    $(".navbar-brand").on('mouseenter', function () {
        $('#logo-animado').toggleClass('oculto-opacidad');
        $('#logo').addClass('oculto-opacidad')
    });

    $(".navbar-brand").on('mouseleave', function () {
        $('#logo-animado').toggleClass('oculto-opacidad');
        $('#logo').removeClass('oculto-opacidad');
    });
});

// Funciones de búsqueda y filtros ----------------------------------------------

function filtrarJugador() {

    const cards = $(".cardJugador");
    const infoJugadores = document.getElementById("infoJugadores");
    const alturaDiv = $(document.getElementById("caja-jugadores")).height();

    // Get filtro nombre
    let filtroNombre = (document.getElementById("inputBuscarNombre").value).toUpperCase();

    // Get filtros genero
    const checkboxesGenero = $(document.getElementById("generoCheckGroup")).find('input[type=checkbox]');
    var selectedGenero = [];
    $(checkboxesGenero).each(function () {
        if ($(this).is(":checked")) {
            selectedGenero.push($(this));
        }
    });

    // Get filtros posición
    const checkboxesPosicion = $(document.getElementById("posicionCheckGroup")).find('input[type=checkbox]');
    var selectedPosicion = [];
    $(checkboxesPosicion).each(function () {
        if ($(this).is(":checked")) {
            selectedPosicion.push($(this));
        }
    });

    // Get filtros extracomunitario
    const checkboxesExtracomunitario = $(document.getElementById("extracomunitarioCheckGroup")).find('input[type=checkbox]');
    var selectedExtracomunitario = [];
    $(checkboxesExtracomunitario).each(function () {
        if ($(this).is(":checked")) {
            selectedExtracomunitario.push($(this));
        }
    });

    // Get filtros disponibilidad
    const checkboxesDisponibilidad = $(document.getElementById("disponibilidadCheckGroup")).find('input[type=checkbox]');
    var selectedDisponibilidad = [];
    $(checkboxesDisponibilidad).each(function () {
        if ($(this).is(":checked")) {
            selectedDisponibilidad.push($(this));
        }
    });

    // ------------------------------------

    // Obtener y ocultar todos los cards
    let elementos = [];
    for (let i = 0; i < cards.length; i++) {
        elementos.push(cards[i]);
        cards[i].style.display = "none";
    }

    // Filtro de nombre
    let elementosNombre = null;
    if (filtroNombre.length != 0) {
        elementosNombre = [];
        for (let i = 0; i < elementos.length; i++) {
            txtValue = ($(cards[i]).data("nombre")).toUpperCase();
            if (txtValue.indexOf(filtroNombre) > -1) {
                elementosNombre.push(elementos[i]);
            }
        }
    }

    // Filtro de género
    let elementosGenero = null;
    if (selectedGenero.length != 0) {
        elementosGenero = [];
        let array;
        if (elementosNombre != null) {
            array = elementosNombre;
        } else {
            array = elementos;
        }
        for (let i = 0; i < array.length; i++) {
            txtValue = $(array[i]).data("genero");
            for (let j = 0; j < array.length; j++) {
                genero = $(selectedGenero[j]).attr("id")
                if (txtValue == genero) {
                    elementosGenero.push(array[i]);
                }
            }
        }
    }

    // Filtro de posicion
    let elementosPosicion = null;
    if (selectedPosicion.length != 0) {
        elementosPosicion = [];
        let array;
        if (elementosGenero != null) {
            array = elementosGenero;
        } else if (elementosNombre != null) {
            array = elementosNombre;
        } else {
            array = elementos;
        }
        for (let i = 0; i < array.length; i++) {
            txtValue = $(array[i]).data("posicion");
            for (let j = 0; j < selectedPosicion.length; j++) {
                posicion = $(selectedPosicion[j]).attr("id")
                if (txtValue == posicion) {
                    elementosPosicion.push(array[i]);
                }
            }
        }
    }

    // Filtro de extracomunitario
    var elementosExtracomunitario = null;
    if (selectedExtracomunitario.length != 0) {
        elementosExtracomunitario = [];
        let array;
        if (elementosPosicion != null) {
            array = elementosPosicion;
        } else if (elementosGenero != null) {
            array = elementosGenero;
        } else if (elementosNombre != null) {
            array = elementosNombre;
        } else {
            array = elementos;
        }
        for (let i = 0; i < array.length; i++) {
            txtValue = $(array[i]).data("extracomunitario");
            for (let j = 0; j < selectedExtracomunitario.length; j++) {
                posicion = $(selectedExtracomunitario[j]).attr("id")
                if (txtValue == posicion) {
                    elementosExtracomunitario.push(array[i]);
                }
            }
        }
    }

    // Filtro de disponibilidad
    var elementosDisponibilidad = null;
    if (selectedDisponibilidad.length != 0) {
        elementosDisponibilidad = [];
        let array;
        if (elementosExtracomunitario != null) {
            array = elementosExtracomunitario;
        } else if (elementosPosicion != null) {
            array = elementosPosicion;
        } else if (elementosGenero != null) {
            array = elementosGenero;
        } else if (elementosNombre != null) {
            array = elementosNombre;
        } else {
            array = elementos;
        }
        for (let i = 0; i < array.length; i++) {
            txtValue = $(array[i]).data("disponibilidad");
            for (let j = 0; j < selectedDisponibilidad.length; j++) {
                disponibilidad = $(selectedDisponibilidad[j]).attr("id")
                if (txtValue == disponibilidad) {
                    elementosDisponibilidad.push(array[i]);
                }
            }
        }
    }


    // ------------------------------------

    // Show resultados
    let arrayMostrar;
    if (elementosDisponibilidad != null) {
        arrayMostrar = elementosDisponibilidad;
    } else if (elementosExtracomunitario != null) {
        arrayMostrar = elementosExtracomunitario;
    } else if (elementosPosicion != null) {
        arrayMostrar = elementosPosicion;
    } else if (elementosGenero != null) {
        arrayMostrar = elementosGenero;
    } else if (elementosNombre != null) {
        arrayMostrar = elementosNombre;
    } else {
        arrayMostrar = elementos;
    }
    let i = 0
    for (i; i < arrayMostrar.length; i++) {
        arrayMostrar[i].style.display = "";
    }


    if (i == 0) {
        $(infoJugadores).text("Oops... la búsqueda no ha generado ningún resultado");
    } else {
        $(infoJugadores).text("Mostrando " + i + " resultados");
    }

}

function quitarFiltros() {
    const filtroNombre = document.getElementById("inputBuscarNombre");
    const infoJugadores = document.getElementById("infoJugadores");
    const cajaCheckBox = document.getElementById("filtros");
    const checkboxes = $(cajaCheckBox).find('input[type=checkbox]');
    filtroNombre.value = "";
    for (let j = 0; j < checkboxes.length; j++) {
        checkboxes[j].checked = false;
    }
    const cards = $(".cardJugador");

    for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "";
    }

    $(infoJugadores).text("Mostrando " + cards.length + " resultados");

}

