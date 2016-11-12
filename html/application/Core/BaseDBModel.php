<?php

namespace Mini\Core;

use PDO;


class BaseDBModel
{
    /**
     * @var null Database Connection
     */
    public $db = null;
    // ajout de cet attribut permettant de bosser en local sans base mySql
    public $fake = false;

    /**
     * Whenever model is created, open a database connection.
     */
    function __construct()
    {
        if (ENVIRONMENT !== 'dev')
        {
            try {
                self::openDatabaseConnection();
            } catch (PDOException $e) {
                exit('Database connection could not be established.');
            }
        }
        // En environnement de dév local, on active le flag 'fake' pour proposer des valeurs bidons
        else {
            // En dev on affiche des données bidons
            $this->fake = true;
        }
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
}
