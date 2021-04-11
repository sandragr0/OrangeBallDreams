<?php
class Database
{
    public static function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=odb_proyecto;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}