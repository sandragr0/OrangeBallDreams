<?php

/**
 * Description of codigosError
 *
 * @author Sandra
 */
abstract class CodigosError
{
    // Códigos de error de usuarios (login)
    const usuario_empty = 1;
    const pass_empty = 2;
    const user_not_exists = 3;

    // Códigos de error de jugadores
    const nombre_invalid = 4;
    const nombre_empty = 5;
    const apellido1_invalid = 6;
    const apellido1_empty = 7;
    const apellido2_invalid = 8;
    const fechaNac_invalid = 9;
    const telefono_invalid = 10;
    const altura_invalid = 11;
    const dni_invalid = 12;
    const equipo_invalid = 13;
    const imagen_wrong_format = 14;
    const imagen_wrong_size = 15;

    // Códigos de error de la base de datos
    const db_duplicate_entry = 16;
    const db_generic_error = 17;


}
