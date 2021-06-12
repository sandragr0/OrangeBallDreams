<?php

/**
 * Class Database
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com>sandraguerreror1995@gmail.com</a>
 */
class Database
{
    /**
     * Function connect
     * @return \PDO
     */
    public static function connect(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=orangeballdreams;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}