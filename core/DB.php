<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 12.11.2015
 * Time: 23:37
 */

namespace Core;


class DB
{

    /**
     * @param $config
     * @return \PDO
     */
    public static function createPDO($config) {
        try {
            $pdo = new \PDO("mysql:host=" . $config->DB_HOST . ";dbname=". $config->DB_NAME,
                $config->DB_USER, $config->DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            exit("Error Connect to DB: $ex->errorInfo");
        }
        return $pdo;
    }
}
