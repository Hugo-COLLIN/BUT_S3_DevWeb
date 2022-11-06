<?php

namespace iutnc\deefy\db;

use \PDO as PDO;

/**
 * The class' goal is to set up a connection between the app and the database
 */
class ConnectionFactory
{
    /**
     *
     * @var PDO|null PHP Data Object
     */
    public static ?PDO $db = null;

    /**
     * @var array Configuration information extracted from external file
     */
    public static array $config = [];


    /**
     * Extract information from an external file
     * @param string $file file path
     * @return void
     */
    public static function setConfig(string $file): void
    {
        self::$config = parse_ini_file($file);
    }

    /**
     * Method that creates a new connection to the database
     * @return PDO PHP Data Object
     */
    public static function makeConnection() : PDO
    {
        if (self::$db == null) {
            $dsn = self::$config['driver'] .
                ':host=' . self::$config['host'] .
                ';dbname=' . self::$config['database'];

            self::$db = new PDO($dsn, self::$config['username'], self::$config['password'], [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_STRINGIFY_FETCHES => false,
            ]);
            self::$db->prepare('SET NAMES \'UTF8\'')->execute();
        }
        return self::$db;
    }

}