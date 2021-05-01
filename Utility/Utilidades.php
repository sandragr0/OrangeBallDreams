<?php

class Utilidades {

    static function fechaToFormulario($fecha) {
        $fechaArray = explode("-", $fecha);
        return $fechaArray[2] . "/" . $fechaArray[1] . "/" . $fechaArray[0];
    }

    static function fechaToBD($fecha) {
        $fechaArray = explode("/", $fecha);
        return $fechaArray[2] . "-" . $fechaArray[1] . "-" . $fechaArray[0];
    }

    static function isAlpha($string) {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú\s]+$)/", $string)) {
            return true;
        }
        return false;
    }

    static function isEmpty($string) {
        if ($string == "") {
            return true;
        }
        return false;
    }

    static function isValidPasswd($string) {
        if (preg_match("/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/", $string)) {
            return true;
        }
        return false;
    }

}
