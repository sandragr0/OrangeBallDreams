<?php


/**
 * Class Utilidades
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
abstract class Utilidades
{

    /**
     * Function getDocumentRoot
     * @return string
     */
    static function getDocumentRoot(): string
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }


    /**
     * Function isAlpha
     * @param $string
     * @return bool
     */
    static function isAlpha($string): bool
    {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú0-9\s]+$)/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isStringWithWhiteSpaces
     * @param $string
     * @return bool
     */
    static function isStringWithWhiteSpaces($string): bool
    {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú\s]+$)/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isString
     * @param $string
     * @return bool
     */
    static function isString($string): bool
    {
        if (preg_match("/(^[A-Za-zñÑá-úÁ-Ú]+$)/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isTelefono
     * @param $string
     * @return bool
     */
    static function isTelefono($string): bool
    {
        if (preg_match("/(^[0-9]{9}$)/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isAltura
     * @param $string
     * @return bool
     */
    static function isAltura($string): bool
    {
        if (preg_match("/(^[0-9].[0-9]{2}$)/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isEmpty
     * @param $string
     * @return bool
     */
    static function isEmpty($string): bool
    {
        if ($string == "") {
            return true;
        }
        return false;
    }


    /**
     * Function isDNI
     * @param $string
     * @return bool
     */
    static function isDNI($string): bool
    {
        if (preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke]$/', $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function cleanValue
     * @param $string
     * @return string
     */
    static function cleanValue($string): string
    {
        return strip_tags(trim($string));
    }


    /**
     * Function isFecha
     * @param $fecha
     * @return bool
     */
    static function isFecha($fecha): bool
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


    /**
     * Function isTemporada
     * @param $string
     * @return bool
     */
    static function isTemporada($string): bool
    {
        if (preg_match("/^[0-9]{2}[-][0-9]{2}$/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isNumeroValidoHastaDosCifras
     * @param $num
     * @return bool
     */
    static function isNumeroValidoHastaDosCifras($num): bool
    {
        if (preg_match("/^[0-9]{1,2}$/", $num)) {
            return true;
        }
        return false;
    }


    /**
     * Function isNumeroValidoHastaTresCifras
     * @param $num
     * @return bool
     */
    static function isNumeroValidoHastaTresCifras($num): bool
    {
        if (preg_match("/^[0-9]{1,3}$/", $num)) {
            return true;
        }
        return false;
    }


    /**
     * Function isDecimalHastaDosCifras
     * @param $num
     * @return bool
     */
    static function isDecimalHastaDosCifras($num): bool
    {
        if (preg_match("/^[0-9]{1,2}[.][0-9]$/", $num)) {
            return true;
        }
        return false;
    }


    /**
     * Function isRuta
     * @param $string
     * @return bool
     */
    static function isRuta($string): bool
    {
        if (preg_match("/^http.*youtube.com.*(embed).+$/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isCorreoElectronico
     * @param $string
     * @return bool
     */
    static function isCorreoElectronico($string): bool
    {
        if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isValidUsuario
     * @param $string
     * @return bool
     */
    static function isValidUsuario($string): bool
    {
        if (preg_match("/[a-zA-Z0-9]{6,12}/", $string)) {
            return true;
        }
        return false;
    }


    /**
     * Function isValidPassword
     * @param $string
     * @return bool
     */
    static function isValidPassword($string): bool
    {
        if (preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $string)) {
            return true;
        }
        return false;
    }

    /**
     * Function mb_ucfirst
     * @param $string
     * @param string $encoding
     * @return string
     */
    static function mb_ucfirst($string, string $encoding = 'UTF-8'): string
    {
        $stringLenght = mb_strlen($string, $encoding);
        $primerCaracter = mb_substr($string, 0, 1, $encoding);
        $resto = mb_substr($string, 1, $stringLenght - 1, $encoding);
        return mb_strtoupper($primerCaracter, $encoding) . $resto;
    }

    /**
     * Function imgFormatoCorrecto
     * @param $type
     * @return bool
     */
    static function imgFormatoCorrecto($type): bool
    {
        if ($type == "image/jpeg" || $type == "image/png") {
            return true;
        }
        return false;
    }

    /**
     * Function isValidImgSize
     * @param $size
     * @return bool
     */
    static function isValidImgSize($size): bool
    {
        if ($size <= 2097152) {
            return true;
        }
        return false;
    }

    /**
     * Function logError
     * @param $e
     */
    static function logError($e)
    {
        $log_filename = $_SERVER['DOCUMENT_ROOT'] . "/logs/log_" . date('Ymd') . ".log";
        if (!file_exists($log_filename)) {
            fopen($log_filename, "x");
        }
        error_log(date("H:i:s") . " " . $e->getMessage() . "\n", 3, $log_filename);
    }


}
