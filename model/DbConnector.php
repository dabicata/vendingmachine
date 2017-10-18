<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/16/17
 * Time: 3:22 PM
 */

namespace vending\model;

/**
 * This Class connects you to database and perform Queries.
 * Class DbConnector
 * @package vending
 */
class DbConnector
{
    const  DSN = "mysql:dbname=vending_machine;host=127.0.0.1";
    const USER = "work";
    const PASSWORD = "workpass";
    private $dataBase;

    /**
     * DbConnector constructor.
     * Opens a connection to database.
     */
    public function __construct()
    {
        try {
            $this->dataBase = new \PDO(SELF::DSN, SELF::USER, SELF::PASSWORD);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }


    /**
     * Close the database connection.
     */
    public function closeConnection()
    {
        $this->dataBase = null;
    }

    /**
     * Takes sql and parameters for sql and performs  insert, update, delete query.
     * @param $sql holds the sql.
     * @param iterable|holds $parameters holds parameters for sql
     */
    public function executeQuery($sql, iterable $parameters)
    {
        $query = $this->dataBase->prepare($sql);
        $counter = 1;
        foreach ($parameters as $param) {
            $query->bindParam($counter, $param);
            $counter++;
        }
        var_dump($query);
        var_dump($parameters);
        $query->execute();
    }

    /**
     * Takes sql and parameters for sql and performs select query.
     * @param $sql holds the sql.
     * @param iterable|holds $parameters holds parameters for sql
     * @return array of the query
     */
    public function selectQuery($sql, iterable $parameters)
    {
        $query = $this->dataBase->prepare($sql);
        $counter = 1;
        foreach ($parameters as $param) {
            $query->bindParam($counter, $param);
            $counter++;
        }
        $query->execute();
        var_dump($query->fetchAll(\PDO::FETCH_OBJ));
        var_dump(new \DateTime());
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }
}

