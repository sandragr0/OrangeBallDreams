<?php

/**
 * Class Utilidades
 */
abstract class Utilidades
{

    /**
     * @return string
     */
    static function getDocumentRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams";
    }

    /**
     * @param $fecha
     * @return string
     */
    static function fechaToFormulario($fecha)
    {
        $fechaArray = explode("-", $fecha);
        return $fechaArray[2] . "/" . $fechaArray[1] . "/" . $fechaArray[0];
    }

    /**
     * @param $fecha
     * @return string
     */
    static function fechaToBD($fecha)
    {
        $fechaArray = explode("/", $fecha);
        return $fechaArray[2] . "-" . $fechaArray[1] . "-" . $fechaArray[0];
    }

    /**
     * @param $string
     * @return bool
     */
    static function isAlpha($string)
    {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú0-9\s]+$)/", $string)) {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    static function isString($string)
    {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú]+$)/", $string)) {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    static function isTelefono($string)
    {
        if (preg_match("/(^[0-9]{9}+$)/", $string)) {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    static function isAltura($string)
    {
        if (preg_match("/(^[0-9]{1}[.]{1}[0-9]{2}+$)/", $string)) {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    static function isEmpty($string)
    {
        if ($string == "") {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    static function isDNI($string)
    {
        if (preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke]{1}$/', $string)) {
            return true;
        }
        return false;
    }

    /**
     * @param $string
     * @return string
     */
    static function cleanValue($string)
    {
        return strip_tags(trim($string));
    }

    /**
     * @param $fecha
     * @return bool
     */
    static function isFecha($fecha)
    {
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

    static function isTemporada($string)
    {
        if (preg_match("/^[0-9]{2}[-]{1}[0-9]{2}$/", $string)) {
            return true;
        }
        return false;
    }

    static function isNumeroValidoHastaDosCifras($num)
    {
        if (preg_match("/^[0-9]{1,2}$/", $num)) {
            return true;
        }
        return false;
    }

    static function isNumeroValidoHastaTresCifras($num)
    {
        if (preg_match("/^[0-9]{1,3}$/", $num)) {
            return true;
        }
        return false;
    }

    static function isDecimalHastaDosCifras($num)
    {
        if (preg_match("/^[0-9]{1}[.]{1}[0-9]{1}$/", $num)) {
            return true;
        }
        return false;
    }

    static function isRuta($string) {
        if (preg_match("/^http.*youtube.com{1}.*(embed){1}.+$/", $string)) {
            return true;
        }
        return false;
    }

    static function isCorreoElectronico($string) {
        if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/", $string)) {
            return true;
        }
        return false;
    }

    static function isValidUsuario($string) {
        if (preg_match("/[a-zA-Z0-9]{6,12}/", $string)) {
            return true;
        }
        return false;
    }

    static function isValidPassword($string) {
        if (preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * @param $string
     * @param string $encoding
     * @return string
     */
    static function mb_ucfirst($string, $encoding = 'UTF-8')
    {
        $stringLenght = mb_strlen($string, $encoding);
        $primerCaracter = mb_substr($string, 0, 1, $encoding);
        $resto = mb_substr($string, 1, $stringLenght - 1, $encoding);
        return mb_strtoupper($primerCaracter, $encoding) . $resto;
    }

    /**
     * @param $type
     * @return bool
     */
    static function imgFormatoCorrecto($type)
    {
        if ($type == "image/jpeg" || $type == "image/png") {
            return true;
        }
        return false;
    }

    /**
     * @param $size
     * @return bool
     */
    static function isValidImgSize($size)
    {
        if ($size <= 2097152) {
            return true;
        }
        return false;
    }

    static function logError($e)
    {
        $log_filename = $_SERVER['DOCUMENT_ROOT'] . "/OrangeBallDreams/logs/log_" . date('Ymd') . ".log";
        if (!file_exists($log_filename)) {
            fopen($log_filename, "x");
        }
        error_log(date("H:i:s") . " " . $e->getMessage() . "\n", 3, $log_filename);
    }


}
