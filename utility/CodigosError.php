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

    // Códigos de error de usuarios (add)
    const usuario_invalid = 34;
    const correo_electronico_empty = 35;
    const correo_electronico_invalid = 36;
    const pass_invalid = 37;

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

    // Códigos de error de estadísticas
    const temporada_empty = 18;
    const temporada_invalid = 19;
    const liga_empty = 20;
    const liga_invalid = 21;
    const ppp_invalid = 22;
    const app_invalid = 23;
    const rpp_invalid = 24;
    const porcentajeTirosDobles_invalid = 25;
    const porcentajeTirosTriples_invalid = 26;
    const porcentajeTirosLibres_invalid = 27;
    const tap_invalid = 28;
    const rob_invalid = 29;
    const min_invalid = 30;

    // Códigos de error de vídeos
    const ruta_empty = 31;
    const ruta_invalid = 32;

    // Códigos de error de contactos
    const nota_invalid = 33;
}
