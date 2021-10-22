<?php


class Db
{
    /*public static function getConnection()
    {

        $params = require_once ROOT . '/config/db_params.php';

       $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        try {
            $db = new \PDO($dsn, $params['user'], $params['password'], $options);
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $db;

    }*/

    private static $connect = false;
    private static $db;

    public static function getConnection() {
        if(self::$connect == false){
            $paramsPath = ROOT."/config/db_params.php";
            $params = include_once($paramsPath);


            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];


            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";


            try {
                self::$db = new \PDO($dsn, $params['user'], $params['password'], $options);
                self::$db->exec("set names utf8");
                self::$connect = true;
            }catch (\PDOException $e){
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                }


        }
        return self::$db;

    }


}