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

    static function isString($string) {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú]+$)/", $string)) {
            return true;
        }
        return false;
    }

    static function isTelefono($string) {
        if (preg_match("/(^[0-9]{9}+$)/", $string)) {
            return true;
        }
        return false;
    }

    static function isAltura($string) {
        if (preg_match("/(^[0-9]{1}[.]{1}[0-9]{2}+$)/", $string)) {
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

    static function isDNI($string) {
        if (preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke]{1}$/', $string)) {
            return true;
        }
        return false;
    }

    static function cleanString($string) {
        return strip_tags(trim($string));
    }

    static function isFecha($fecha) {
        $fechaArray = explode("-", $fecha);
        if (count($fechaArray) == 3) {
            if (is_numeric($fechaArray[0]) && is_numeric($fechaArray[1]) && is_numeric($fechaArray[2])) {
                if (checkdate($fechaArray[1], $fechaArray[2], $fechaArray[0])) {
                    return true;
                }
            }
        }
        return false;
    }

    static function mb_ucfirst($string, $encoding = 'UTF-8') {
        $stringLenght = mb_strlen($string, $encoding);
        $primerCaracter = mb_substr($string, 0, 1, $encoding);
        $resto = mb_substr($string, 1, $stringLenght - 1, $encoding);
        return mb_strtoupper($primerCaracter, $encoding) . $resto;
    }
    
   static function imgFormatoCorrecto($type) {
       if ($type == "image/jpeg" || $type == "image/png") {
           return true;
       } 
       return false;
   }
   
   static function isValidImgSize($size) { 
       if ($size <= 2097152) {
           return true;
       }
       return false;
   }
   

}
